<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserProfilePolicy
{
    /**
     * Determina se o utilizador pode listar os perfis.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
