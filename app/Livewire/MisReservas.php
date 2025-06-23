<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelacionReservaMail;
use App\Models\Historial;
use App\Models\Reserva;
use Carbon\Carbon;
use Livewire\WithPagination;

class MisReservas extends Component
{
    use WithPagination;

    public $reserva_id;
    public $nueva_fecha, $nueva_hora;
    public $modalReprogramarAbierto = false;

    public function abrirModalReprogramar($id)
    {
        $this->reserva_id = $id;
        $this->modalReprogramarAbierto = true;
    }

    public function reprogramarReserva()
    {
        $hora = \Carbon\Carbon::parse($this->nueva_hora);

        if ($hora->lt(Carbon::createFromTime(9, 0)) || $hora->gt(Carbon::createFromTime(17, 0))) {
            $this->addError('hora', 'El horario debe estar entre 9:00 y 17:00.');
            return;
        }
        
        $reserva = Reserva::find($this->reserva_id);

        $reservada = Reserva::where('user_id', Auth::id())
            ->where('fecha', $this->nueva_fecha)
            ->where('hora', $this->nueva_hora)
            ->where('id', '!=', $this->reserva_id)
            ->exists();

        if ($reservada) {
            $this->addError('nueva_fecha', 'Ya tienes una reserva para esta fecha y hora.');
            return;
        }

        $yaReservado = Reserva::where('sede_id', $reserva->sede_id)
            ->whereDate('fecha', $this->nueva_fecha)
            ->whereTime('hora', $this->nueva_hora)
            ->count();

        $capacidad = $reserva->sede->capacidad_maxima;

        if ($yaReservado >= $capacidad) {
            $this->addError('nueva_fecha', 'La nueva fecha y hora no están disponibles.');
            return;
        }

        Historial::create([
            'reserva_id' => $reserva->id,
            'accion' => 'Reprogramación',
            'detalles' => 'De ' . $reserva->fecha . ' ' . $reserva->hora . ' a ' . $this->nueva_fecha . ' ' . $this->nueva_hora,
        ]);

        $reserva->update([
            'fecha' => $this->nueva_fecha,
            'hora' => $this->nueva_hora,
        ]);

        $this->modalReprogramarAbierto = false;
        session()->flash('message', 'Reserva reprogramada exitosamente.');
    }

    public function cancelar($id)

    {
        $reserva = Reserva::where('user_id', Auth::id())->findOrFail($id);
        $reserva->estado = 'cancelada';
        $reserva->save();

        Mail::to($reserva->user->email)->send(new CancelacionReservaMail($reserva));
    }

    public function render()
    {
        $reservas = Reserva::where('user_id', Auth::id())
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('livewire.mis-reservas', ['reservas' => $reservas])->layout('layouts.app');
    }
}
