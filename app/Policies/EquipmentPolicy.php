<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Equipment;
use App\Models\User;

final class EquipmentPolicy
{
    /**
     * Determines whether the user can view the equipment listing.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can view a specific equipment.
     */
    public function view(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can create new equipment.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can update an existing equipment.
     */
    public function update(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can delete an equipment.
     */
    public function delete(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Custom method kept for compatibility.
     */
    public function manage(User $user, ?Equipment $equipment = null): bool
    {
        return $user->isAdmin();
    }

    /**
     * Custom method kept for compatibility.
     */
    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
