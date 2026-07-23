<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Trait ControllerHelpers
 */
trait ControllerHelpers
{
    /**
     * Resolve e valida o utilizador atualmente autenticado.
     */
    protected function authenticatedUser(Request $request): User
    {
        return Auth::guard('api')->user() ?? $request->user();
    }

    /**
     * Garante que o utilizador possui um dos perfis/papéis permitidos.
     */
    protected function requireRole(User $user, array $roles): void
    {
        if (! $user->profile || ! in_array($user->profile->name, $roles, true)) {
            abort(403, 'Acesso proibido para o seu perfil.');
        }
    }
}
