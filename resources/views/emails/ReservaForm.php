<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionReservaMail;

class ReservaForm extends Component
{
    public $fecha, $hora;

    public function guardarReserva()
    {
        $this->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $reserva = Reserva::create([
            'usuario_id' => Auth::id(),
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        $estado = 'creada';
        Mail::to(Auth::user()->email)->send(new NotificacionReservaMail(Auth::user(), $reserva, $estado));
    }

    public function render()
    {
        return view('livewire.reserva-form');
    }
}
