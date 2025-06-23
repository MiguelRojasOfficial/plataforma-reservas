<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SedeSaturadaNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     */
    public function __construct($sede, $fecha)
    {
        $this->sede = $sede;
        $this->fecha = $fecha;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('⚠️ Sede saturada')
            ->line("La sede {$this->sede->nombre} ha alcanzado su capacidad máxima para el día {$this->fecha}.")
            ->line('Por favor, toma las medidas necesarias.');
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => 'Sede saturada',
            'mensaje' => "La sede {$this->sede->nombre} se ha saturado el {$this->fecha}.",
        ];
    }
}