<?php

namespace Tests\Fixtures\Builders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserBuilder
{
    private array $attributes = [];

    public function __construct()
    {
        $this->attributes = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
            'active' => true,
        ];
    }

    public static function new(): self
    {
        return new self;
    }

    public function withName(string $name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->attributes['email'] = $email;

        return $this;
    }

    public function withPassword(string $password): self
    {
        $this->attributes['password'] = Hash::make($password);

        return $this;
    }

    public function withProfile(string $profileName): self
    {
        $profile = UserProfile::firstOrCreate(['name' => $profileName]);
        $this->attributes['profile_id'] = $profile->id;

        return $this;
    }

    public function asAdmin(): self
    {
        return $this->withProfile(User::ROLE_ADMIN);
    }

    public function asTechnician(): self
    {
        return $this->withProfile(User::ROLE_TECHNICIAN);
    }

    public function asUser(): self
    {
        return $this->withProfile(User::ROLE_USER);
    }

    public function withToken(string $token): self
    {
        $this->attributes['api_token'] = $token;

        return $this;
    }

    public function inactive(): self
    {
        $this->attributes['active'] = false;

        return $this;
    }

    public function build(): User
    {
        return User::factory()->create($this->attributes);
    }

    public function buildArray(): array
    {
        return $this->attributes;
    }
}
