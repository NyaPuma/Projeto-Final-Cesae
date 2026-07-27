<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;

final class UserService
{
    public function getAvailableRoles(): array
    {
        return UserRoleEnum::values();
    }

    public function ensureDefaultProfile(User $user): void
    {
        if ($user->profile_id) {
            return;
        }

        $defaultProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $user->profile_id = $defaultProfile->id;
    }

    public function hashToken(string $token): string
    {
        return hash_hmac('sha256', $token, config('app.key'));
    }
}
