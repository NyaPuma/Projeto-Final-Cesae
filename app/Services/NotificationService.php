<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;

final class NotificationService
{
    public function __construct(
        private readonly BudgetNotificationService $budgetService,
        private readonly TicketNotificationService $ticketService,
    ) {}

    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetSubmitted($ticket, $message);
    }

    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetAutoApproved($ticket, $message);
    }

    public function notifyBudgetDecision(Ticket $ticket, string $decision, string $message): void
    {
        $this->budgetService->notifyBudgetDecision($ticket, $decision, $message);
    }

    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        $this->ticketService->notifyTicketClosed($ticket, $message);
    }

    public function notifyPriorityOverride(Ticket $ticket, User $technician, int $urgentCount): void
    {
        $this->ticketService->notifyPriorityOverride($ticket, $technician->name, $urgentCount);
    }

    public function notifyTicketCreated(Ticket $ticket): void
    {
        $this->budgetService->notifyTicketCreated($ticket);
    }
}
