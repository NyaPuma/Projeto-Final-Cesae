<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\UserProfile;

final class UserProfilePolicy
{
    /**
     * Determines whether the user can list profiles.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
