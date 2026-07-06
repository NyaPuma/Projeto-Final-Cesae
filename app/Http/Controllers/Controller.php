<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Controller
{
    protected function authenticatedUser(Request $request): User
    {
        $token = $request->header('X-Auth-Token') ?: $request->bearerToken();

        if (!is_string($token) || $token === '') {
            abort(401, 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.');
        }

        $user = User::where('api_token', $token)->where('active', true)->first();

        if (!$user) {
            abort(401, 'Token inválido ou utilizador inativo.');
        }

        return $user;
    }

    protected function requireRole(User $user, array $roles): void
    {
        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Acesso proibido para o seu perfil.');
        }
    }
}
