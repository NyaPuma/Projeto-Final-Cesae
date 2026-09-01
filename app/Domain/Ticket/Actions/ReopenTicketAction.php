<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;

final readonly class ReopenTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): bool
    {
        if (! $ticket->hasStatus(TicketStatusEnum::Closed) && ! $ticket->hasStatus(TicketStatusEnum::Cancelled)) {
            return false;
        }

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        return DB::transaction(function () use ($ticket, $openStatusId) {
            $ticket->status_id = $openStatusId;
            $ticket->reopened_at = now();
            $ticket->closed_at = null;

            $saved = $ticket->save();

            return $saved;
        });
    }
}
