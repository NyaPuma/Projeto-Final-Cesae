<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Trait ControllerHelpers
 * @package App\Traits
 */
trait ControllerHelpers
{
    /**
     * Resolve e valida o utilizador atualmente autenticado.
     * * @param Request $request
     * @return User
     */
    protected function authenticatedUser(Request $request): User
    {
        return $request->user();
    }

    /**
     * Garante que o utilizador possui um dos perfis/papéis permitidos.
     * * @param User $user
     * @param array $roles
     * @return void
     */
    protected function requireRole(User $user, array $roles): void
    {
        if (!$user->profile || !in_array($user->profile->name, $roles, true)) {
            abort(403, 'Acesso proibido para o seu perfil.');
        }
    }
}