<?php

namespace App\Traits;



use App\Models\Notificacion;
use Illuminate\Support\Facades\Log;
trait NotificacionTrait
{
    public function crearNotificacion($usuario_id, $tipo, $mensaje)
    {
        return Notificacion::create([
            'usuario_id' => $usuario_id,
            'tipo' => $tipo,
            'mensaje' => $mensaje,
            'leida' => false,
        ]);

        Log::info("Notificación creada para usuario {$usuario_id}: {$titulo} - {$mensaje}");
    }
}
