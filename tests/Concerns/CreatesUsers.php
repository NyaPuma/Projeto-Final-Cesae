<?php

namespace Tests\Concerns;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait CreatesUsers
{
    protected function createUserWithToken(string $profileName, array $attributes = []): User
    {
        $profile = UserProfile::firstOrCreate(['name' => $profileName]);

        return User::factory()->create(array_merge([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ], $attributes));
    }

    protected function createUserWithPassword(string $profileName, string $email, string $password, array $attributes = []): User
    {
        $profile = UserProfile::firstOrCreate(['name' => $profileName]);

        return User::factory()->create(array_merge([
            'email' => $email,
            'password' => Hash::make($password),
            'profile_id' => $profile->id,
            'active' => true,
            'api_token' => Str::random(60),
        ], $attributes));
    }

    protected function createAdmin(array $attributes = []): User
    {
        return $this->createUserWithToken(User::ROLE_ADMIN, $attributes);
    }

    protected function createTechnician(array $attributes = []): User
    {
        return $this->createUserWithToken(User::ROLE_TECHNICIAN, $attributes);
    }

    protected function createRegularUser(array $attributes = []): User
    {
        return $this->createUserWithToken(User::ROLE_USER, $attributes);
    }

    protected function createInactiveUser(string $profileName = User::ROLE_USER): User
    {
        return $this->createUserWithToken($profileName, ['active' => false]);
    }

    protected function createUsers(int $count, string $profileName = User::ROLE_USER): array
    {
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->createUserWithToken($profileName);
        }

        return $users;
    }

    protected function ensureUserProfilesExist(): void
    {
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
    }
}
