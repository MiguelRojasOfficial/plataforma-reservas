<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use App\Notifications\CambioDisponibilidadNotification;
use App\Notifications\SedeSaturadaNotification;

class DashboardAdmin extends Component
{
    public $totalReservas;
    public $pendientes;
    public $confirmadas;
    public $canceladas;
    public $notificaciones;
    public $reservasPendientes;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $this->totalReservas = Reserva::count();
        $this->pendientes = Reserva::where('estado', 'pendiente')->count();
        $this->confirmadas = Reserva::where('estado', 'confirmada')->count();
        $this->canceladas = Reserva::where('estado', 'cancelada')->count();

        $this->notificaciones = Auth::user()
            ->unreadNotifications
            ->whereIn('type', [
                CambioDisponibilidadNotification::class,
                SedeSaturadaNotification::class
            ])
            ->take(5);

        $this->reservasPendientes = Reserva::with('user')
            ->where('estado', 'pendiente')
            ->latest()
            ->take(10)
            ->get();
    }

    public function confirmar($id)
    {
        $reserva = Reserva::find($id);
        if ($reserva && $reserva->estado === 'pendiente') {
            $reserva->estado = 'confirmada';
            $reserva->save();
            $this->cargarDatos();
        }
    }

    public function cancelar($id)
    {
        $reserva = Reserva::find($id);
        if ($reserva && $reserva->estado !== 'cancelada') {
            $reserva->estado = 'cancelada';
            $reserva->save();
            $this->cargarDatos();
        }
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }
}
