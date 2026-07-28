<?php

namespace App\Domain\Ticket\Services;

use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;

final readonly class TicketStatusChecker
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function hasStatus(?int $ticketStatusId, TicketStatusEnum $status): bool
    {
        if (! $ticketStatusId) {
            return false;
        }

        $expectedStatusId = $this->statusService->getByName($status);

        return $ticketStatusId === $expectedStatusId;
    }
}
