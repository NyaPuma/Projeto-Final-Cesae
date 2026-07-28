<?php

namespace App\Policies;

use App\Models\Equipment;
use App\Models\User;

final class EquipmentPolicy
{
    public function manage(User $user, ?Equipment $equipment = null): bool
    {
        return $user->isAdmin();
    }

    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
