<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Part;
use App\Models\User;

final class PartPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function view(User $user, Part $part): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Part $part): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Part $part): bool
    {
        return $user->isAdmin();
    }
}
