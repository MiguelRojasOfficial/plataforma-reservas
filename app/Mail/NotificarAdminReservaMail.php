<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarAdminReservaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;


    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('Nueva reserva realizada')
                    ->view('emails.notificar-admin');
    }
}