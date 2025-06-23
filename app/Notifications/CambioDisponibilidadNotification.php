<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CambioDisponibilidadNotification extends Notification
{
    use Queueable;

    public function __construct(public $disponibilidad) {}
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Cambio en disponibilidad detectado')
                    ->line('Se ha detectado un cambio en una franja de disponibilidad.')
                    ->line('Fecha: ' . $this->disponibilidad->fecha)
                    ->line('Hora: ' . $this->disponibilidad->hora)
                    ->line('Nuevo estado: ' . $this->disponibilidad->estado);
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => 'Cambio en disponibilidad: ' . $this->disponibilidad->fecha . ' ' . $this->disponibilidad->hora,
            'estado' => $this->disponibilidad->estado,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
