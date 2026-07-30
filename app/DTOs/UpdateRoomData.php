<?php

namespace App\DTOs;

final readonly class UpdateRoomData
{
    public function __construct(
        public ?string $name = null,
        public ?string $code = null,
        public ?string $location = null,
        public ?bool $active = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            code: $data['code'] ?? null,
            location: $data['location'] ?? null,
            active: $data['active'] ?? null,
        );
    }
}
