<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reserva;
use Livewire\WithPagination;

class AdminReservas extends Component
{
    use WithPagination;

    public $search = '';

    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = 'cancelada';
        $reserva->save();
    }

    public function confirmar($id)
{
    $reserva = Reserva::findOrFail($id);
    $reserva->estado = 'confirmada';
    $reserva->save();
}

    public function render()
    {
        $reservas = Reserva::with('user')
            ->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('livewire.admin-reservas', compact('reservas'))
               ->layout('layouts.app');
    }
}