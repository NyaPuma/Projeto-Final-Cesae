<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\MaintenancePlan;
use App\Models\User;

final class MaintenancePlanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function view(User $user, MaintenancePlan $plan): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, MaintenancePlan $plan): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, MaintenancePlan $plan): bool
    {
        return $user->isAdmin();
    }
}
