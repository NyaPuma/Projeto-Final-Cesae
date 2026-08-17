<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\StockMovement;
use App\Models\User;

final class StockMovementPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function view(User $user, StockMovement $movement): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function delete(User $user, StockMovement $movement): bool
    {
        return $user->isAdmin();
    }
}
