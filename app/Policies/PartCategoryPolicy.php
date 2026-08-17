<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PartCategory;
use App\Models\User;

final class PartCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function view(User $user, PartCategory $category): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, PartCategory $category): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, PartCategory $category): bool
    {
        return $user->isAdmin();
    }
}
