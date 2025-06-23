<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use App\Models\Reserva;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionReservaMail;

class ReservasEdit extends Component
{
	public $reserva_id, $sede_id, $fecha, $hora, $usuario_id;
	public $users, $sedes;

	public function mount(Reserva $reserva)
	{
		$this->reserva_id = $reserva->id;
		$this->sede_id = $reserva->sede_id;
		$this->fecha = $reserva->fecha;
		$this->hora = $reserva->hora;
		$this->usuario_id = $reserva->user_id;

		$this->users = User::all();
		$this->sedes = Sede::all();
	}

	public function update()
	{
		$this->validate([
			'sede_id' => 'required|exists:sedes,id',
			'fecha' => 'required|date',
			'hora' => 'required',
			'usuario_id' => 'required|exists:users,id',
		], [
			'sede_id.required' => 'La sede es obligatoria.',
            'fecha.required' => 'La fecha es obligatoria.',
            'hora.required' => 'La hora es obligatoria.',
            'usuario_id.required' => 'El usuario es obligatorio.',
        ]);
		$reserva = Reserva::find($this->reserva_id);
		$reserva->update([
			'sede_id' => $this->sede_id,
			'fecha' => $this->fecha,
			'hora' => $this->hora,
			'user_id' => $this->usuario_id,
		]);

		Mail::to($reserva->user->email)->send(new NotificacionReservaMail($reserva->user, $reserva, 'actualizada'));

		return redirect()->route('reservas.index')->with ('success', 'Reserva actualizada correctamente.');
	}

	public function render()
	{
		return view('livewire.resrvas-edit');
	}
}