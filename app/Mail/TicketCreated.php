<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class TicketCreated extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Ticket $ticket,
    ) {}

    /**
     * Define o envelope e assunto da mensagem.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nova avaria registada [#{$this->ticket->id}]",
        );
    }

    /**
     * Define o conteúdo e a template da mensagem.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticketCreated',
        );
    }

    /**
     * Anexos para a mensagem.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
