<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    /**
     * Determina se o utilizador pode listar os utilizadores.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTechnician();
    }

    /**
     * Determina se o utilizador pode visualizar um utilizador específico.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->isTechnician() || $user->id === $model->id;
    }

    /**
     * Determina se o utilizador pode criar novos utilizadores.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o utilizador pode atualizar os dados de um utilizador.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    /**
     * Determina se o utilizador pode eliminar um utilizador.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $user->id !== $model->id;
    }

    /**
     * Determina se o utilizador pode atualizar o perfil.
     */
    public function updateProfile(User $user, ?User $target = null): bool
    {
        if ($target === null) {
            return true;
        }

        return $user->isAdmin() || $user->id === $target->id;
    }

    /**
     * Determina se o administrador pode inativar um utilizador.
     */
    public function inactivate(User $admin, User $target): bool
    {
        return $admin->isAdmin()
            && $admin->id !== $target->id
            && ! $target->isAdmin();
    }

    /**
     * Método personalizado de gestão geral de utilizadores.
     */
    public function manage(User $admin, ?User $target = null): bool
    {
        if ($target === null) {
            return $admin->isAdmin();
        }

        return $admin->isAdmin() && $admin->id !== $target->id;
    }

    /**
     * Método personalizado para verificar permissão ampla de gestão.
     */
    public function manageAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
