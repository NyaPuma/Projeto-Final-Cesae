<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class TestMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $recipientName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teste de Envio de E-mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test-mail',
            // O $recipientName já é injetado automaticamente na view por ser uma propriedade pública
        );
    }
}
