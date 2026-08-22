<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class TicketStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Ticket $ticket,
        public readonly string $oldStatus,
        public readonly string $newStatus,
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
        $oldLabel = $this->resolveStatusLabel($this->oldStatus);
        $newLabel = $this->resolveStatusLabel($this->newStatus);

        $subject = "Ticket #{$this->ticket->id} - Estado atualizado para {$newLabel}";

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Olá, {$notifiable->name}!")
            ->line('O estado do seu ticket foi atualizado.')
            ->line("**Ticket:** #{$this->ticket->id} — {$this->ticket->title}")
            ->line("**Estado anterior:** {$oldLabel}")
            ->line("**Novo estado:** {$newLabel}")
            ->action('Ver Ticket', url("/ui/tickets/{$this->ticket->id}"))
            ->line('Obrigado por utilizar o sistema de gestão de avarias.');
    }

    /**
     * Database representation of the notification (User Panel).
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $newLabel = $this->resolveStatusLabel($this->newStatus);

        return [
            'ticket_id'  => $this->ticket->id,
            'title'      => "Estado do ticket #{$this->ticket->id} alterado",
            'message'    => "O ticket \"{$this->ticket->title}\" mudou para {$newLabel}.",
            'type'       => 'info',
            'link'       => "/ui/tickets/{$this->ticket->id}",
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }

    /**
     * Resolves the human-friendly status label from a string or enum.
     */
    private function resolveStatusLabel(string $status): string
    {
        $enum = TicketStatusEnum::tryFrom($status);

        if ($enum && method_exists($enum, 'label')) {
            return $enum->label();
        }

        foreach (TicketStatusEnum::cases() as $case) {
            if (method_exists($case, 'label') && $case->label() === $status) {
                return $case->label();
            }
        }

        return $status;
    }
}
