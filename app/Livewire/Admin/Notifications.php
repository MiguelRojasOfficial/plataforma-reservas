<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminNotification;

class Notifications extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = AdminNotification::orderBy('created_at', 'desc')->get();
    }

    public function marcarLeido($id)
    {
        $notificacion = AdminNotification::find($id);
        $notificacion->leido = true;
        $notificacion->save();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.notifications');
    }
}
