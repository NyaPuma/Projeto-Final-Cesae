<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class CheckHigherPriorityAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): array
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
