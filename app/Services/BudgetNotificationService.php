<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Ticket;

final class BudgetNotificationService
{
    /**
     * @param NotificationCreatorService $creator
     */
    public function __construct(
        private readonly NotificationCreatorService $creator,
    ) {}

    /**
     * Notifies budget submission to administrators and ticket creator.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        $this->creator->createForAdmins(
            title: "Pending Budget - Ticket #{$ticket->id}",
            message: $message,
            type: NotificationTypeEnum::BudgetRequest->value,
            link: "/ui/tickets/{$ticket->id}",
        );

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: "Budget Submitted - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetSubmitted->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifies budget auto-approval to the assigned technician and ticket creator.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        if ($ticket->assigned_to) {
            $this->creator->createForUser(
                userId: $ticket->assigned_to,
                title: "Auto-Approved - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetAutoApproved->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: "Budget Auto-Approved - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetAutoApproved->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifies budget decision (approved or rejected).
     *
     * @param Ticket $ticket
     * @param string $decision
     * @param string $message
     */
    public function notifyBudgetDecision(Ticket $ticket, string $decision, string $message): void
    {
        $type = $decision === 'approve' ? NotificationTypeEnum::BudgetApproved : NotificationTypeEnum::BudgetRejected;

        if ($ticket->assigned_to) {
            $label = $decision === 'approve' ? 'Approved' : 'Rejected';
            $this->creator->createForUser(
                userId: $ticket->assigned_to,
                title: "Budget {$label} - Ticket #{$ticket->id}",
                message: $message,
                type: $type->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: "Budget Decision - Ticket #{$ticket->id}",
                message: $message,
                type: $type->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifies new ticket creation to administrators.
     *
     * @param Ticket $ticket
     */
    public function notifyTicketCreated(Ticket $ticket): void
    {
        $this->creator->createForAdmins(
            title: "New Ticket - #{$ticket->id}",
            message: "New ticket created: {$ticket->title}",
            type: NotificationTypeEnum::TicketCreated->value,
            link: "/ui/tickets/{$ticket->id}",
        );
    }
}
