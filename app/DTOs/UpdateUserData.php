<?php

namespace App\DTOs;

final readonly class UpdateUserData
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?int $profileId = null,
        public ?bool $active = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            profileId: $data['profile_id'] ?? null,
            active: $data['active'] ?? null,
        );
    }

    public function hasPassword(): bool
    {
        return $this->password !== null && $this->password !== '';
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'profile_id' => $this->profileId,
            'active' => $this->active,
        ], fn ($v) => $v !== null);
    }
}
