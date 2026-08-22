<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

final class RoomPolicy
{
    /**
     * Determines whether the user can view the room listing.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can view a specific room.
     */
    public function view(User $user, Room $room): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determines whether the user can create new rooms.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can update an existing room.
     */
    public function update(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determines whether the user can delete a room.
     */
    public function delete(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }

    /**
     * Custom method kept for compatibility.
     */
    public function manage(User $user, ?Room $room = null): bool
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
