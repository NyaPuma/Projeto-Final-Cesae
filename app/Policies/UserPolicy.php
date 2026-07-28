<?php

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function manage(User $admin, ?User $target = null): bool
    {
        return $admin->isAdmin();
    }

    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function updateProfile(User $user): bool
    {
        return true;
    }

    public function inactivate(User $admin, User $target): bool
    {
        return $admin->isAdmin() && ! $target->isAdmin();
    }
}
