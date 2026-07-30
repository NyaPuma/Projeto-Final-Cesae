<?php

namespace App\DTOs;

final readonly class CloseTicketData
{
    public function __construct(
        public float $actualCost,
        public ?string $report = null,
        public bool $force = false,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            actualCost: (float) ($data['actual_cost'] ?? 0),
            report: $data['report'] ?? null,
            force: (bool) ($data['force'] ?? false),
        );
    }
}
