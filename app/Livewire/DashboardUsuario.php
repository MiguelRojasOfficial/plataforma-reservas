<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardUsuario extends Component
{
    public function render()
    {
        return view('livewire.dashboard-usuario')->layout('layouts.app');
    }
}