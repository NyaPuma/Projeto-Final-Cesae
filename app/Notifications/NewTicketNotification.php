<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class NewTicketNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Ticket $ticket,
    ) {}

    /**
     * Defines the notification channels (mail and database).
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $ticketUrl = url("/ui/tickets/{$this->ticket->id}");

        return (new MailMessage)
            ->subject("Novo Ticket Registado [#{$this->ticket->id}]")
            ->greeting("Olá, {$notifiable->name}!")
            ->line("Um novo ticket de manutenção foi registado com o título: **{$this->ticket->title}**.")
            ->line("Prioridade: **" . ucfirst((string) $this->ticket->priority) . "**")
            ->action('Ver Ticket', $ticketUrl)
            ->line('Aceda ao painel de controlo para atribuir ou acompanhar o progresso deste chamado.')
            ->salutation('Cumprimentos, Sistema de Gestão de Manutenção');
    }

    /**
     * Database representation of the notification (User Panel).
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title'     => 'Novo chamado registado',
            'message'   => "Foi criado o ticket #{$this->ticket->id}: {$this->ticket->title}",
            'type'      => 'info',
            'link'      => "/ui/tickets/{$this->ticket->id}",
        ];
    }
}
