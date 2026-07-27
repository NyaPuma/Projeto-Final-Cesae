<?php

namespace App\Policies;

use App\Models\User;

final class EquipmentPolicy
{
    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }
}
