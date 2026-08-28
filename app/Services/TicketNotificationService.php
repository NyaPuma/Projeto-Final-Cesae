<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Ticket;

final class TicketNotificationService
{
    /**
     * @param NotificationCreatorService $creator
     */
    public function __construct(
        private readonly NotificationCreatorService $creator,
    ) {}

    /**
     * Notifies the ticket creator user about ticket closure.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: "Ticket Closed - #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::TicketClosed->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifies administrators when a technician starts a ticket ignoring more urgent ones.
     *
     * @param Ticket $ticket
     * @param string $technicianName
     * @param int $urgentCount
     */
    public function notifyPriorityOverride(Ticket $ticket, string $technicianName, int $urgentCount): void
    {
        $title = "Non-Priority Ticket - #{$ticket->id}";
        $message = "Technician {$technicianName} started ticket #{$ticket->id} ({$ticket->title}) with priority '{$ticket->priority}', ignoring {$urgentCount} more urgent pending ticket(s).";

        $this->creator->createForAdmins(
            title: $title,
            message: $message,
            type: NotificationTypeEnum::PriorityOverride->value,
            link: "/ui/tickets/{$ticket->id}",
        );
    }
}
