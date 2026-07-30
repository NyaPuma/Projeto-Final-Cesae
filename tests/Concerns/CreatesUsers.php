<?php

namespace Tests\Concerns;


use App\Enums\UserRoleEnum;
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
        return $this->createUserWithToken(UserRoleEnum::Admin->value, $attributes);
    }

    protected function createTechnician(array $attributes = []): User
    {
        return $this->createUserWithToken(UserRoleEnum::Technician->value, $attributes);
    }

    protected function createRegularUser(array $attributes = []): User
    {
        return $this->createUserWithToken(UserRoleEnum::User->value, $attributes);
    }

    protected function createInactiveUser(string $profileName = UserRoleEnum::User->value): User
    {
        return $this->createUserWithToken($profileName, ['active' => false]);
    }

    protected function createUsers(int $count, string $profileName = UserRoleEnum::User->value): array
    {
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->createUserWithToken($profileName);
        }

        return $users;
    }

    protected function ensureUserProfilesExist(): void
    {
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
    }
}
