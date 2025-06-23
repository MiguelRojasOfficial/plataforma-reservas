<?php

namespace App\Livewire\Reservas;

use Livewire\Component;
use App\Models\Reserva;
use Livewire\WithPagination;

class ReservasIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $motivoCancelacion = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function cancelarReservaConfirmada()
    {
        $this->validate([
            'motivoCancelacion' => 'required|string|min:5',
        ]);

        $reserva = Reserva::findOrFail($this->reservaIdParaCancelar);
        $reserva->estado = 'cancelada';
        $reserva->motivo_cancelacion = $this->motivoCancelacion;
        $reserva->save();

        $this->reset(['reservaIdParaCancelar', 'mostrarModalConfirmacion', 'motivoCancelacion']);
        session()->flash('message', 'Reserva cancelada con éxito.');
    }

    public function cancelar($id)
    {
        $reserva = Reserva::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $reserva->delete();
        session()->flash('message', 'Reserva cancelada correctamente.');
    }

    public function render()
    {
        $reservas = Reserva::where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('fecha', 'like', "%{$this->search}%")
                      ->orWhere('hora', 'like', "%{$this->search}%");
            })
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('livewire.reservas.reservas-index', [
            'reservas' => $reservas,
        ]);
    }
}
