<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class NotificacionesUsuario extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = Notificacion::where('usuario_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function marcarComoLeida($id)
    {
        $notificacion = Notificacion::find($id);
        if ($notificacion && $notificacion->usuario_id == Auth::id()) {
            $notificacion->leida = true;
            $notificacion->save();
            $this->mount(); // refresca lista
        }
    }

    public function render()
    {
        return view('livewire.notificaciones-usuario');
    }
}
