<?php

namespace App\DTOs;

final readonly class UpdateEquipmentData
{
    public function __construct(
        public ?string $name = null,
        public ?string $serial = null,
        public ?int $roomId = null,
        public ?int $categoryId = null,
        public ?bool $active = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            serial: $data['serial'] ?? null,
            roomId: $data['room_id'] ?? null,
            categoryId: $data['category_id'] ?? null,
            active: $data['active'] ?? null,
        );
    }
}
