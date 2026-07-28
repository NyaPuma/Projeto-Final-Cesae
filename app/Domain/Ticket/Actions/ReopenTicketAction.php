<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class ReopenTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): bool
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
}
