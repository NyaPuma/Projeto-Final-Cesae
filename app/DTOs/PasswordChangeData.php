<?php

namespace App\DTOs;

final readonly class PasswordChangeData
{
    public function __construct(
        public string $currentPassword,
        public string $newPassword,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            currentPassword: $data['current_password'],
            newPassword: $data['new_password'],
        );
    }
}
