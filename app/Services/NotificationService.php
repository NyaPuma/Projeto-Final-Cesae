<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;

final class NotificationService
{
    /**
     * @param BudgetNotificationService $budgetService
     * @param TicketNotificationService $ticketService
     */
    public function __construct(
        private readonly BudgetNotificationService $budgetService,
        private readonly TicketNotificationService $ticketService,
    ) {}

    /**
     * Notifies budget submission.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetSubmitted($ticket, $message);
    }

    /**
     * Notifies budget auto-approval.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetAutoApproved($ticket, $message);
    }

    /**
     * Notifies budget decision.
     *
     * @param Ticket $ticket
     * @param string $decision
     * @param string $message
     */
    public function notifyBudgetDecision(Ticket $ticket, string $decision, string $message): void
    {
        $this->budgetService->notifyBudgetDecision($ticket, $decision, $message);
    }

    /**
     * Notifies ticket closure.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        $this->ticketService->notifyTicketClosed($ticket, $message);
    }

    /**
     * Notifies priority override on a technician.
     *
     * @param Ticket $ticket
     * @param User $technician
     * @param int $urgentCount
     */
    public function notifyPriorityOverride(Ticket $ticket, User $technician, int $urgentCount): void
    {
        $this->ticketService->notifyPriorityOverride($ticket, $technician->name, $urgentCount);
    }

    /**
     * Notifies new ticket creation.
     *
     * @param Ticket $ticket
     */
    public function notifyTicketCreated(Ticket $ticket): void
    {
        $this->budgetService->notifyTicketCreated($ticket);
    }
}
