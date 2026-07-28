<?php

namespace App\DTOs;

final readonly class UpdateRoomData
{
    public function __construct(
        public string $name,
        public string $code,
        public string $location,
        public ?bool $active = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'],
            location: $data['location'],
            active: $data['active'] ?? null,
        );
    }
}
