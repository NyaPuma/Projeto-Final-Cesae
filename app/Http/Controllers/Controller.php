<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function authenticatedUser(Request $request): User
    {
        $user = Auth::guard('api')->user() ?? $request->user();

        if (! $user) {
            abort(401, 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.');
        }

        return $user;
    }

    protected function requireRole(User $user, array $roles): void
    {
        if (! $user->profile || ! in_array($user->profile->name, $roles, true)) {
            abort(403, 'Acesso proibido para o seu perfil.');
        }
    }

    protected function jsonNotFound(string $message = 'Não encontrado'): JsonResponse
    {
        return response()->json(['message' => $message], 404);
    }

    protected function jsonValidationError($errors): JsonResponse
    {
        return response()->json(['errors' => $errors], 422);
    }
}
