<?php

namespace App\Policies;

use App\Models\User;

final class RoomPolicy
{
    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }
}
