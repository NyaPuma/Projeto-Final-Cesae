<?php

namespace App\Domain\Ticket\Services;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;

final readonly class TicketStatusChecker
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    /**
     * Verifica se um Ticket ou ID de estado corresponde ao estado do enum esperado.
     */
    public function hasStatus(Ticket|int|null $ticketOrStatusId, TicketStatusEnum $status): bool
    {
        $statusId = $ticketOrStatusId instanceof Ticket
            ? $ticketOrStatusId->status_id
            : $ticketOrStatusId;

        if ($statusId === null || $statusId <= 0) {
            return false;
        }

        $expectedStatusId = $this->statusService->getByName($status);

        if ($expectedStatusId === null) {
            return false;
        }

        return $statusId === $expectedStatusId;
    }
}
