<?php

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Ticket;

final class TicketNotificationService
{
    public function __construct(
        private readonly NotificationCreatorService $creator,
    ) {}

    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: NotificationTypeEnum::TicketClosed->icon()." Ticket Fechado - #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::TicketClosed->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    public function notifyPriorityOverride(Ticket $ticket, string $technicianName, int $urgentCount): void
    {
        $title = NotificationTypeEnum::PriorityOverride->icon()." Ticket Não Prioritário - #{$ticket->id}";
        $message = "O técnico {$technicianName} iniciou o ticket #{$ticket->id} ({$ticket->title}) com prioridade '{$ticket->priority}', ignorando {$urgentCount} ticket(s) mais urgente(s) pendentes.";

        $this->creator->createForAdmins(
            title: $title,
            message: $message,
            type: NotificationTypeEnum::PriorityOverride->value,
            link: "/ui/tickets/{$ticket->id}",
        );
    }
}
