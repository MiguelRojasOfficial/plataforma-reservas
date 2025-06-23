<?php 
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ConfirmarCuenta extends Component
{
    public $token;
    public $mensaje;

    public function mount($token)
    {
        $this->token = $token;

        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();
        

            $this->mensaje = 'Tu cuenta ha sido confirmada con éxito. Ya puedes iniciar sesión.';
        } else {
            $this->mensaje = 'El enlace de confirmación no es válido o ya fue usado.';
        }
    }

    public function render()
    {
        return view('livewire.confirmar-cuenta');
    }
}
