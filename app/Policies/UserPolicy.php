<?php

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function manage(User $admin): bool
    {
        return $admin->isAdmin();
    }

    public function inactivate(User $admin, User $target): bool
    {
        return $admin->isAdmin() && ! $target->isAdmin();
    }
}
