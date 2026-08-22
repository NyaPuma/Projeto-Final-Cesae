<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    /**
     * Determines whether the user can list users.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can view a specific user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->isTechnician() || $user->id === $model->id;
    }

    /**
     * Determines whether the user can create new users.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can update another user's data.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    /**
     * Determines whether the user can delete a user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $user->id !== $model->id;
    }

    /**
     * Determines whether the user can update the profile.
     */
    public function updateProfile(User $user, ?User $target = null): bool
    {
        if ($target === null) {
            return true;
        }

        return $user->isAdmin() || $user->id === $target->id;
    }

    /**
     * Determines whether the admin can inactivate a user.
     */
    public function inactivate(User $admin, User $target): bool
    {
        return $admin->isAdmin()
            && $admin->id !== $target->id
            && ! $target->isAdmin();
    }

    /**
     * Custom method for general user management.
     */
    public function manage(User $admin, ?User $target = null): bool
    {
        if ($target === null) {
            return $admin->isAdmin();
        }

        return $admin->isAdmin() && $admin->id !== $target->id;
    }

    /**
     * Custom method to check broad management permission.
     */
    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
