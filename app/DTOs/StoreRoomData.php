<?php

namespace App\DTOs;

final readonly class StoreRoomData
{
    public function __construct(
        public string $name,
        public ?string $location = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            location: $data['location'] ?? null,
        );
    }
}
