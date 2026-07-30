<?php

namespace App\Notifications;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusChanged extends Notification
{
    use Queueable;

    public function __construct(
        protected Ticket $ticket,
        protected string $oldStatus,
        protected string $newStatus
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

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
            ->line('Obrigado por usar o sistema de gestão de avarias.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }

    private function resolveStatusLabel(string $status): string
    {
        foreach (TicketStatusEnum::cases() as $enum) {
            if ($enum->value === $status || $enum->label() === $status) {
                return $enum->label();
            }
        }

        return $status;
    }
}
