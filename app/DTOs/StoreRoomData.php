<?php

namespace App\DTOs;

final readonly class StoreRoomData
{
    public function __construct(
        public string $name,
        public ?string $code = null,
        public ?string $location = null,
        public ?bool $active = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'] ?? null,
            location: $data['location'] ?? null,
            active: $data['active'] ?? null,
        );
    }
}
