<?php

namespace App\DTOs;

use App\Enums\TicketPriorityEnum;

final readonly class CreateTicketData
{
    public function __construct(
        public string $title,
        public string $description,
        public TicketPriorityEnum $priority,
        public ?int $equipmentId = null,
        public ?int $roomId = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            priority: TicketPriorityEnum::normalize($data['priority']),
            equipmentId: $data['equipment_id'] ?? null,
            roomId: $data['room_id'] ?? null,
        );
    }
}
