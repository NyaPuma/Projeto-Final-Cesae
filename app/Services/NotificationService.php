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
     * Notifica a submissão de um orçamento.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetSubmitted($ticket, $message);
    }

    /**
     * Notifica a auto-aprovação de um orçamento.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        $this->budgetService->notifyBudgetAutoApproved($ticket, $message);
    }

    /**
     * Notifica a decisão sobre um orçamento.
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
     * Notifica o encerramento de um ticket.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        $this->ticketService->notifyTicketClosed($ticket, $message);
    }

    /**
     * Notifica a sobreposição de prioridade num técnico.
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
     * Notifica a criação de um novo ticket.
     *
     * @param Ticket $ticket
     */
    public function notifyTicketCreated(Ticket $ticket): void
    {
        $this->budgetService->notifyTicketCreated($ticket);
    }
}
