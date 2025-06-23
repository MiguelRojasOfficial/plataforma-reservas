<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Mail\ConfirmacionRegistroMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);


        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'verification_token' => \Str::random(40),
        ]);

        $urlConfirmacion = route('confirmar.cuenta', ['token' => $user->verification_token]);

        Mail::to($user->email)->send(new ConfirmacionRegistroMail($user, $urlConfirmacion));
        
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}
