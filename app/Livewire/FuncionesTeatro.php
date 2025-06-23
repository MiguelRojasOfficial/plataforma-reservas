<?php

namespace App\Livewire;

use Livewire\Component;

class FuncionesTeatro extends Component
{
    public $funciones = [];

    public function mount()
{
    $this->funciones = [
        [
            'titulo' => 'Hamlet',
            'fecha' => '2025-06-15',
            'hora' => '15:00',
            'lugar' => 'Teatro Principal',
            'imagen' => 'hamlet.webp'
        ],
        [
            'titulo' => 'El rey Lear',
            'fecha' => '2025-06-17',
            'hora' => '20:00',
            'lugar' => 'Sala B',
            'imagen' => 'lear.webp'
        ],
        [
            'titulo' => 'La Casa de Bernarda',
            'fecha' => '2025-06-20',
            'hora' => '20:00',
            'lugar' => 'Teatro Principal',
            'imagen' => 'casa.webp',
        ],
        [
            'titulo' => 'La importancia',
            'fecha' => '2025-06-20',
            'hora' => '20:00',
            'lugar' => 'Sala B',
            'imagen' => 'importancia.webp',
        ],
    ];
}

    public function render()
    {
        return view('livewire.funciones-teatro')->layout('layouts.app');
    }
}