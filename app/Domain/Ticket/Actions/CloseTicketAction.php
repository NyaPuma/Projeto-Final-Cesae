<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;

final readonly class CloseTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(
        Ticket $ticket,
        ?float $cost = null,
        ?string $report = null,
        ?int $minutesSpent = null
    ): bool {
        $closedStatusId = $this->statusService->getByName(TicketStatusEnum::Closed);

        if ($ticket->status_id === $closedStatusId) {
            return true;
        }

        return DB::transaction(function () use ($ticket, $closedStatusId, $cost, $report, $minutesSpent) {
            $attributes = [
                'status_id' => $closedStatusId,
                'closed_at' => $ticket->closed_at ?? now(),
            ];

            if ($cost !== null) {
                $attributes['actual_cost'] = $cost;
            }

            if ($report !== null) {
                $attributes['technical_report'] = $report;
            }

            if ($minutesSpent !== null) {
                $attributes['minutes_spent'] = $minutesSpent;
            }

            $updated = $ticket->update($attributes);

            return $updated;
        });
    }
}
