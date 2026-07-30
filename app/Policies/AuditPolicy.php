<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Audit;
use App\Models\User;

final class AuditPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
