<?php

namespace App\Domain\Ticket\ValueObjects;

use Carbon\CarbonInterface;

final readonly class BudgetPauseMinutes
{
    public function __construct(
        private ?CarbonInterface $requestedAt,
        private ?CarbonInterface $decidedAt,
    ) {}

    public function value(): int
    {
        if ($this->requestedAt && $this->decidedAt) {
            return (int) $this->requestedAt->diffInMinutes($this->decidedAt);
        }

        return 0;
    }
}
