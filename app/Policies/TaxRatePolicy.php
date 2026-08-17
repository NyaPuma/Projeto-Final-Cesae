<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TaxRate;
use App\Models\User;

final class TaxRatePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function view(User $user, TaxRate $taxRate): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, TaxRate $taxRate): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, TaxRate $taxRate): bool
    {
        return $user->isAdmin();
    }
}
