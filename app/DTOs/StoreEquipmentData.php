<?php

namespace App\DTOs;

final readonly class StoreEquipmentData
{
    public function __construct(
        public string $name,
        public string $serial,
        public ?int $roomId = null,
        public ?int $categoryId = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            serial: $data['serial'],
            roomId: $data['room_id'] ?? null,
            categoryId: $data['category_id'] ?? null,
        );
    }
}
