<?php

namespace App\DTOs;

final readonly class ScheduleTicketData
{
    public function __construct(
        public string $scheduledAt,
        public ?string $scheduledEnd = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            scheduledAt: $data['scheduled_at'],
            scheduledEnd: $data['scheduled_end'] ?? null,
        );
    }
}
