<?php

namespace App\DTOs;

final readonly class StoreUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $profileId,
        public bool $active = true,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            profileId: $data['profile_id'],
            active: isset($data['active']) ? (bool) $data['active'] : true,
        );
    }
}
