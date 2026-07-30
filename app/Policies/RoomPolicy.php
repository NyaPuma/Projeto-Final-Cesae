<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

final class RoomPolicy
{
    public function manage(User $user, ?Room $room = null): bool
    {
        return $user->isAdmin();
    }

    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
