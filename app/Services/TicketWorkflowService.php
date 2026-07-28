<?php

namespace App\Services;

use App\Domain\Ticket\Actions\CancelTicketAction;
use App\Domain\Ticket\Actions\CheckHigherPriorityAction;
use App\Domain\Ticket\Actions\CloseTicketAction;
use App\Domain\Ticket\Actions\ReopenTicketAction;
use App\Domain\Ticket\Actions\StartTicketAction;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;

final class TicketWorkflowService
{
    public function __construct(
        private readonly TicketStatusService $statusService,
        private readonly StartTicketAction $startAction,
        private readonly CloseTicketAction $closeAction,
        private readonly ReopenTicketAction $reopenAction,
        private readonly CancelTicketAction $cancelAction,
        private readonly CheckHigherPriorityAction $checkHigherPriorityAction,
    ) {}

    public function startRepair(Ticket $ticket): bool
    {
        return $this->startAction->execute($ticket);
    }

    public function reopen(Ticket $ticket): bool
    {
        return $this->reopenAction->execute($ticket);
    }

    public function cancel(Ticket $ticket): bool
    {
        return $this->cancelAction->execute($ticket);
    }

    public function close(Ticket $ticket, ?float $cost = null, ?string $report = null, ?int $minutesSpent = null): bool
    {
        return $this->closeAction->execute($ticket, $cost, $report, $minutesSpent);
    }

    public function checkAutoClose(Ticket $ticket, float $threshold): bool
    {
        if ($ticket->cost === null || $ticket->cost > $threshold) {
            return false;
        }

        $statusId = $this->statusService->getByName(TicketStatusEnum::Closed);
        if ($statusId !== null) {
            $ticket->status_id = $statusId;
        }

        $ticket->closed_at = now();

        return $ticket->save();
    }

    public function findHigherPriorityTickets(Ticket $ticket): array
    {
        return $this->checkHigherPriorityAction->execute($ticket);
    }
}
