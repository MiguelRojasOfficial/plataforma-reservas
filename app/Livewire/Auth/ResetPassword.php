<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public string $email = '';
    public string $token;
    public string $password = '';
    public string $password_confirmation = '';

    public function mount($token, $email) 
    {
        $this->token = $token;
        $this->email = $email;

        $registro = \DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$registro || !Hash::check($token, $registro->token)) {
                abort(404, 'Token no encontrado o inválido.');
            }
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.exists' => 'El correo no está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
        }

        session()->flash('error', __($status));
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('layouts.app');
    }
}
