<?php

namespace App\Observers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;

final readonly class UserObserver
{
    public function creating(User $user): void
    {
        $this->ensureValidProfile($user);
    }

    public function updating(User $user): void
    {
        $this->ensureValidProfile($user);
    }

    private function ensureValidProfile(User $user): void
    {
        if ($user->profile_id) {
            $profileName = UserProfile::where('id', $user->profile_id)->value('name');
            if ($profileName && in_array($profileName, UserRoleEnum::values(), true)) {
                return;
            }
        }

        $existingProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $user->profile_id = $existingProfile->id;
    }
}
