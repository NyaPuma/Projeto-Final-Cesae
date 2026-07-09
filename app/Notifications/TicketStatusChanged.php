<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Notificação enviada ao criador do ticket quando o estado da avaria muda.
 * Suporta canal de email. Pode ser estendida com canais adicionais (database, broadcast).
 */
class TicketStatusChanged extends Notification
{
    use Queueable;

    public function __construct(
        protected Ticket $ticket,
        protected string $oldStatus,
        protected string $newStatus
    ) {}

    /**
     * Define os canais de entrega desta notificação.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Constrói a mensagem de email a enviar ao utilizador.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusLabels = [
            'aberta'   => 'Aberta',
            'em curso' => 'Em Curso',
            'fechada'  => 'Fechada',
        ];

        $oldLabel = $statusLabels[$this->oldStatus] ?? $this->oldStatus;
        $newLabel = $statusLabels[$this->newStatus] ?? $this->newStatus;

        $subject = "Ticket #{$this->ticket->id} - Estado atualizado para {$newLabel}";

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Olá, {$notifiable->name}!")
            ->line("O estado do seu ticket foi atualizado.")
            ->line("**Ticket:** #{$this->ticket->id} — {$this->ticket->title}")
            ->line("**Estado anterior:** {$oldLabel}")
            ->line("**Novo estado:** {$newLabel}")
            ->action('Ver Ticket', url("/ui/tickets/{$this->ticket->id}"))
            ->line('Obrigado por usar o sistema de gestão de avarias.');
    }

    /**
     * Representação em array (para canais database/broadcast futuros).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id'  => $this->ticket->id,
            'title'      => $this->ticket->title,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }
}
