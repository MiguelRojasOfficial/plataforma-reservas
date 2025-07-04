<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

 
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }
  
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.auth.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
	return $this->subject('Restablecer contraseña')
		    ->markdown('emails.auth.reset-password');
    }
}
