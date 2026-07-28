<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class StartTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): bool
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        if ($statusId === null) {
            return false;
        }

        $ticket->status_id = $statusId;
        $ticket->in_progress_at = now();

        return $ticket->save();
    }
}
