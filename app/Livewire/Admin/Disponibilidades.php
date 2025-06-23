<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Disponibilidad;

class Disponibilidades extends Component
{
    public $fecha, $hora_inicio, $hora_fin;
    public $disponibilidades;
    public $editId = null;
 
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin'];

    protected $rules = [
        'fecha' => 'required|date',
        'hora_inicio' => 'required',
        'hora_fin' => 'required|after:hora_inicio',
    ];

    protected $messages = [
        'fecha.required' => 'La fecha es obligatoria.',
        'hora_inicio.required' => 'La hora de inicio es obligatoria.',
        'hora_fin.required' => 'La hora de fin es obligatoria.',
        'hora_fin.after' => 'La hora de fin debe ser después de la hora de inicio.',
    ];

    public function mount()
    {
        $this->loadDisponibilidades();
    }

    public function loadDisponibilidades()
    {
        $this->disponibilidades = Disponibilidad::orderBy('fecha')->orderBy('hora_inicio')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            $disp = Disponibilidad::find($this->editId);
            $disp->update([
                'fecha' => $this->fecha,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
            ]);
            $this->editId = null;
        } else {
            Disponibilidad::create([
                'fecha' => $this->fecha,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
            ]);
        }

        $this->reset(['fecha', 'hora_inicio', 'hora_fin']);
        $this->loadDisponibilidades();
    }

    public function edit($id)
    {
        $disp = Disponibilidad::findOrFail($id);
        $this->editId = $id;
        $this->fecha = $disp->fecha;
        $this->hora_inicio = $disp->hora_inicio;
        $this->hora_fin = $disp->hora_fin;
    }

    public function delete($id)
    {
        Disponibilidad::destroy($id);
        $this->loadDisponibilidades();
    }

    public function render()
    {
        return view('livewire.admin.disponibilidades');
    }
}