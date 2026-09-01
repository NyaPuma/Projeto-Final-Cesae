<?php

namespace App\Domain\Ticket\ValueObjects;

use Carbon\CarbonInterface;
use JsonSerializable;
use Stringable;

final readonly class BudgetPauseMinutes implements JsonSerializable, Stringable
{
    public function __construct(
        public ?CarbonInterface $requestedAt,
        public ?CarbonInterface $decidedAt,
    ) {}

    /**
     * Named constructor for fluent syntax.
     */
    public static function make(?CarbonInterface $requestedAt, ?CarbonInterface $decidedAt): self
    {
        return new self($requestedAt, $decidedAt);
    }

    /**
     * Returns the total minutes elapsed during the pause.
     * Returns 0 if the pause was not completed or if data is invalid.
     */
    public function value(): int
    {
        if ($this->requestedAt === null || $this->decidedAt === null) {
            return 0;
        }

        if ($this->decidedAt->isBefore($this->requestedAt)) {
            return 0;
        }

        return (int) $this->requestedAt->diffInMinutes($this->decidedAt);
    }

    /**
     * Converts the value to hours, rounded to 2 decimal places.
     */
    public function toHours(): float
    {
        return round($this->value() / 60, 2);
    }

    /**
     * Indicates whether the budget pause is still pending a decision.
     */
    public function isPending(): bool
    {
        return $this->requestedAt !== null && $this->decidedAt === null;
    }

    /**
     * Indicates whether no pause time has been accumulated.
     */
    public function isEmpty(): bool
    {
        return $this->value() === 0;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function jsonSerialize(): int
    {
        return $this->value();
    }
}
