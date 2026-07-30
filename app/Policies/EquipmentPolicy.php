<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Equipment;
use App\Models\User;

final class EquipmentPolicy
{
    /**
     * Determina se o utilizador pode visualizar a listagem de equipamentos.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode visualizar um equipamento específico.
     */
    public function view(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode criar novos equipamentos.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode atualizar um equipamento existente.
     */
    public function update(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode eliminar um equipamento.
     */
    public function delete(User $user, Equipment $equipment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Método personalizado mantido para compatibilidade.
     */
    public function manage(User $user, ?Equipment $equipment = null): bool
    {
        return $user->isAdmin();
    }

    /**
     * Método personalizado mantido para compatibilidade.
     */
    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
