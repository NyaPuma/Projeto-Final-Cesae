<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teste de envio por Mailgun'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test-mail',
            with: [
                'recipientName' => $this->recipientName,
            ]
        );
    }
}
