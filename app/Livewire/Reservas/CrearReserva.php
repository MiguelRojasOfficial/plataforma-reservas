<?php

namespace App\Livewire\Reservas;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use App\Models\Disponibilidad;
use App\Models\Reserva;
use App\Models\Notificacion;
use App\Models\AdminNotification;
use App\Models\Sede;
use App\Mail\ConfirmacionReservaMail;
use App\Mail\NotificarAdminReservaMail;
use App\Mail\NotificacionReservaMail;
use App\Notifications\SedeSaturadaNotification;
use App\Traits\NotificacionTrait;

class CrearReserva extends Component
{
    use NotificacionTrait;

	public $fechaSeleccionada;
	public $horaSeleccionada;
	public $detalle;

    public $fechasDisponibles = [];
	public $horasDisponibles = [];
    public $fechasSaturadas = [];

	protected $rules = [
        'fechaSeleccionada' => 'required|date|after_or_equal:today',
        'horaSeleccionada' => 'required',
        'detalle' => 'nullable|string|max:255',
    ];

	protected $messages = [
        'fechaSeleccionada.required' => 'La fecha es obligatoria.',
        'fechaSeleccionada.after_or_equal' => 'La fecha debe ser hoy o posterior.',
        'horaSeleccionada.required' => 'La hora es obligatoria.',
    ];


    protected $listeners = ['fechaSeleccionadaCambiada' => 'actualizarFecha'];


    public $tituloFuncion;

    public function mount($titulo = null)
    {
        $this->tituloFuncion = $titulo;

        $this->fechasDisponibles = Disponibilidad::select('fecha')
            ->distinct()
            ->orderBy('fecha')
            ->pluck('fecha')
            ->toArray();

        $sede = Sede::first();

        if (!$sede) {
            $this->fechasSaturadas = [];
            return;
        }

        $this->fechasSaturadas = Reserva::select('fecha')
            ->where('sede_id', $sede->id)
            ->groupBy('fecha')
            ->havingRaw('COUNT(*) >= ?', [$sede->capacidad_maxima])
            ->pluck('fecha')
            ->toArray();
    }

    public function updatedFechaSeleccionada()
    {
        logger('🚀 Entró a updatedFechaSeleccionada');

        try {
            $this->horaSeleccionada = null;
            logger('📅 Fecha recibida: ' . $this->fechaSeleccionada);

            $horas = [];

            $disponibilidades = Disponibilidad::where('fecha', $this->fechaSeleccionada)->get();

            foreach ($disponibilidades as $d) {
                $start = strtotime(substr($d->hora_inicio, 0, 5));
                $end = strtotime(substr($d->hora_fin, 0, 5));

                for ($time = $start; $time < $end; $time += 1800) {
                    $hora = date('H:i', $time);

                    $ocupada = Reserva::where('fecha', $this->fechaSeleccionada)
                        ->where('hora', $hora)
                        ->exists();

                    if (!$ocupada) {
                        $horas[] = $hora;
                    }
                }
            }

            $this->horasDisponibles = $horas;
            logger('✅ Horas disponibles: ' . json_encode($this->horasDisponibles));
        } catch (\Throwable $e) {
            logger('❌ Error en updatedFechaSeleccionada: ' . $e->getMessage());
        }
    }
   
    public function actualizarFecha($fecha)
    {
        $this->fechaSeleccionada = $fecha;
        $this->updatedFechaSeleccionada();
    }

	public function cargarHorasDisponibles($fecha)
    {
        $disponibilidades = Disponibilidad::where('fecha', $fecha)->get();

        $horas = [];

        foreach ($disponibilidades as $disp) {
        	 $start = strtotime($disp->hora_inicio);
            $end = strtotime($disp->hora_fin);

            for ($time = $start; $time < $end; $time += 1800) { 
            	 $horaFormateada = date('H:i', $time);

            	  $existe = Reserva::where('fecha', $fecha)
                    ->where('hora', $horaFormateada)
                    ->exists();

                if (!$existe) {
                    $horas[] = $horaFormateada;
                }
            }
        }

        $this->horasDisponibles = $horas;
        $this->hora = null;
    }

    public function guardarReserva()
    {
        $this->validate([
            'fechaSeleccionada' => 'required|date|after_or_equal:today',
            'horaSeleccionada' => 'required',
            'detalle' => 'nullable|string|max:255',
        ], [
            'fechaSeleccionada.required' => 'La fecha es obligatoria.',
            'fechaSeleccionada.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'horaSeleccionada.required' => 'La hora es obligatoria.',
        ]);

        $disponibilidad = Disponibilidad::where('fecha', $this->fechaSeleccionada)
            ->where('hora_inicio', '<=', $this->horaSeleccionada)
            ->where('hora_fin', '>', $this->horaSeleccionada)
            ->where('reservada', false)
            ->first();

        if (!$disponibilidad) {
            $this->addError('horaSeleccionada', 'La franja horaria ya fue reservada.');
            return;
        }

        $sede = Sede::find($disponibilidad->sede_id);
        $fecha = $this->fechaSeleccionada;

        if (!$sede) {
    $this->addError('fechaSeleccionada', 'No se encontró la sede asociada a la disponibilidad seleccionada.');
    return;
}

        $totalReservas = Reserva::where('sede_id', $sede->id)
                                ->whereDate('fecha', $fecha)
                                ->count();

        if ($totalReservas >= $sede->capacidad_maxima) {
            $this->addError('fechaSeleccionada', 'No hay más cupos disponibles para esta sede en la fecha seleccionada.');
            return;
        }

        // Crear reserva
        $reserva = Reserva::create([
            'user_id' => Auth::id(),
            'sede_id' => $sede->id,
            'fecha' => $fecha,
            'hora' => $this->horaSeleccionada,
            'detalle' => $this->detalle,
            'estado' => 'pendiente',
        ]);

        $disponibilidad->reservada = true;
        $disponibilidad->save();

        AdminNotification::create([
            'titulo' => 'Nueva reserva creada',
            'mensaje' => 'El usuario ' . Auth::user()->name . ' creó una reserva para ' . $reserva->fecha . ' a las ' . $reserva->hora,
        ]);

        $this->crearNotificacion(
            Auth::id(),
            'Reserva creada',
            "Su reserva para el día {$reserva->fecha} a las {$reserva->hora} ha sido confirmada."
        );

        $admins = \App\Models\User::where('rol', 'admin')->get();
        foreach ($admins as $admin) {
            $this->crearNotificacion(
                $admin->id,
                'Nueva reserva',
                "Nueva reserva realizada por " . auth()->user()->name . " para el día {$reserva->fecha} a las {$reserva->hora}."
            );
        }

        Mail::to(auth()->user()->email)->send(new ConfirmacionReservaMail($reserva));
        $this->notificarAdmins(NotificarAdminReservaMail::class, $reserva);

        session()->flash('message', '¡Reserva confirmada!');
        return redirect()->route('usuario.dashboard');
    }

    protected function notificarAdmins($mailClass, $reserva)
    {
        $admins = \App\Models\User::where('rol', 'admin')->get();

        foreach ($admins as $admin) {
            \Mail::to($admin->email)->send(new $mailClass($reserva));
        }
    }

    public function render()
    {
        return view('livewire.crear-reserva')->layout('layouts.app');
    }
}