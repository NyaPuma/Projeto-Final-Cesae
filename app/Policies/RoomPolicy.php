<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

final class RoomPolicy
{
    /**
     * Determina se o utilizador pode visualizar a listagem de salas.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode visualizar uma sala específica.
     */
    public function view(User $user, Room $room): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode criar novas salas.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode atualizar uma sala existente.
     */
    public function update(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode eliminar uma sala.
     */
    public function delete(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }

    /**
     * Método personalizado mantido para compatibilidade.
     */
    public function manage(User $user, ?Room $room = null): bool
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
