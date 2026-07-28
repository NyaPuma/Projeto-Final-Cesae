<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class CloseTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(
        Ticket $ticket,
        ?float $cost = null,
        ?string $report = null,
        ?int $minutesSpent = null
    ): bool {
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
}
