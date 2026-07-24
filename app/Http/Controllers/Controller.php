<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class Controller
{
    /**
     * Resolve o utilizador autenticado a partir do guard definido pelo CustomAuthMiddleware.
     * O middleware já validou o token (com hash HMAC-SHA256) e configurou o guard antes de
     * o pedido chegar ao controller. Este método apenas recolhe o utilizador do guard.
     *
     * @throws HttpException
     */
    protected function authenticatedUser(Request $request): User
    {
        $user = Auth::guard('api')->user() ?? $request->user();

        if (! $user) {
            abort(401, 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.');
        }

        return $user;
    }

    /**
     * Garante programaticamente que o utilizador possui um dos perfis/papéis permitidos.
     * Caso o perfil não corresponda, lança uma exceção HTTP 403 (Acesso Proibido).
     *
     * @throws HttpException
     */
    protected function requireRole(User $user, array $roles): void
    {
        if (! $user->profile || ! in_array($user->profile->name, $roles, true)) {
            abort(403, 'Acesso proibido para o seu perfil.');
        }
    }
}
