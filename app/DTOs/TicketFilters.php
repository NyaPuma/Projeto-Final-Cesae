<?php

namespace App\DTOs;

use App\Enums\TicketPriorityEnum;

final readonly class TicketFilters
{
    public function __construct(
        public ?string $query = null,
        public ?TicketPriorityEnum $priority = null,
        public ?string $status = null,
        public ?string $dateFrom = null,
        public ?string $dateTo = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            query: $data['q'] ?? null,
            priority: isset($data['priority']) ? TicketPriorityEnum::normalize($data['priority']) : null,
            status: $data['status'] ?? null,
            dateFrom: $data['date_from'] ?? null,
            dateTo: $data['date_to'] ?? null,
        );
    }
}
