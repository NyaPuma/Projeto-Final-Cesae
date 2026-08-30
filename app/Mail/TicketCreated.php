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
     * Defines the envelope and message subject.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('notifications.mail_ticket_created_subject', ['id' => $this->ticket->id]),
        );
    }

    /**
     * Defines the content and template for the message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticketCreated',
        );
    }

    /**
     * Attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
