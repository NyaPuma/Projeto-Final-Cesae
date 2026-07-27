<?php

namespace App\Services;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;

final class TicketWorkflowService
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function startRepair(Ticket $ticket): bool
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        if ($statusId === null) {
            return false;
        }

        $ticket->status_id = $statusId;
        $ticket->in_progress_at = now();

        return $ticket->save();
    }

    public function reopen(Ticket $ticket): bool
    {
        if (! $ticket->hasStatus(TicketStatusEnum::Closed)) {
            return false;
        }

        $statusId = $this->statusService->getByName(TicketStatusEnum::Open);
        if ($statusId !== null) {
            $ticket->status_id = $statusId;
        }

        $ticket->reopened_at = now();
        $ticket->closed_at = null;

        return $ticket->save();
    }

    public function cancel(Ticket $ticket): bool
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::Cancelled);
        $ticket->status_id = $statusId;
        $ticket->closed_at = now();

        return $ticket->save();
    }

    public function close(Ticket $ticket, ?float $cost = null, ?string $report = null, ?int $minutesSpent = null): bool
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::Closed);

        $ticket->update([
            'status_id' => $statusId,
            'closed_at' => now(),
            'minutes_spent' => $minutesSpent,
            'cost' => $cost,
            'technical_report' => $report,
        ]);

        return true;
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
        $currentWeight = TicketPriorityEnum::normalize($ticket->priority)->weight();
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        $higherPriorities = array_filter(
            TicketPriorityEnum::cases(),
            fn (TicketPriorityEnum $p) => $p->weight() > $currentWeight
        );

        $query = Ticket::where('status_id', $openStatusId)
            ->where('id', '!=', $ticket->id)
            ->where(function ($q) use ($higherPriorities) {
                foreach ($higherPriorities as $priority) {
                    $q->orWhere('priority', $priority->value);
                }
            });

        $total = (clone $query)->count();

        $assignedToTicket = (clone $query)
            ->where('assigned_to', $ticket->assigned_to)
            ->count();

        return [
            'total' => $total,
            'assigned_to_user' => $assignedToTicket,
            'has_higher' => $total > 0,
        ];
    }
}
