<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class CancelTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): bool
    {
        $statusId = $this->statusService->getByName(TicketStatusEnum::Cancelled);
        $ticket->status_id = $statusId;
        $ticket->closed_at = now();

        return $ticket->save();
    }
}
