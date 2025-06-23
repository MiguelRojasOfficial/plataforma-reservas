<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login extends Component
{

    public $email = '';
    public $password = '';
    
    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $user = Auth::user();

            if ($user->isAdmin()) {
                session()->flash('message', 'Bienvenido administrador.');
                return redirect()->route('admin.dashboard');
            }

            session()->flash('message', 'Bienvenido de nuevo. Selecciona una función para reservar.');
            return redirect()->route('usuario.dashboard');
        }

        $this->addError('email', 'Correo o contraseña incorrectos');
    }
    
    public function mount($key = null)
    {
         $this->reset(); // Limpia propiedades públicas
        session()->invalidate();
        session()->regenerateToken();
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');

    }
}