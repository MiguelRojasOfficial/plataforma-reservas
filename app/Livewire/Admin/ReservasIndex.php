<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Reserva;
use Livewire\WithPagination;

class ReservasIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $estado = '';
    public $reservaSeleccionada = '';
    public $reservaIdParaCancelar;
    public $mostrarModalConfirmacion = false;
    
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEstado()
    {
        $this->resetPage();
    }

    public function actualizarEstado($reservaId, $nuevoEstado)
    {
        $reserva = Reserva::findOrFail($reservaId);
        $reserva->estado = $nuevoEstado;
        $reserva->save();

        session()->flash('message', 'Estado actualizado correctamente.');
    }

    public function cancelarReserva($reservaId)
    {
        $reserva = Reserva::findOrFail($reservaId);
        $reserva->estado = 'cancelada';
        $reserva->save();

        session()->flash('message', 'La reserva ha sido cancelada.');
    }

    public function confirmarCancelacion($reservaId)
    {
        $this->reservaIdParaCancelar = $reservaId;
        $this->mostrarModalConfirmacion = true;

        if ($this->mostrarModalConfirmacion) {
            $this->dispatchBrowserEvent('mostrarModal');
        }
    }

    public function cancelarReservaConfirmada()
    {
        $reserva = Reserva::findOrFail($this->reservaIdParaCancelar);
        $reserva->estado = 'cancelada';
        $reserva->save();

        $this->reset(['reservaIdParaCancelar', 'mostrarModalConfirmacion']);
        session()->flash('message', 'Reserva cancelada con éxito.');
    }

    public function render()
    {
        $reservas = Reserva::with('usuario', 'sede', 'disponibilidad')
            ->when($this->search, fn($query) =>
                $query->whereHas('usuario', fn($q) =>
                    $q->where('nombre', 'like', '%'.$this->search.'%')
            ) 
        )
        ->when($this->estado, fn($query) =>
            $query->where('estado', $this->estado)
        )
        ->orderBy('fecha_reserva', 'desc')
        ->paginate(10);

        return view('livewire.admin.reservas-index', compact('reservas'));
    }
}