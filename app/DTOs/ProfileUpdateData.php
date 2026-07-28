<?php

namespace App\DTOs;

final readonly class ProfileUpdateData
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}
