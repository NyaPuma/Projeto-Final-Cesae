<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    use AuthorizesRequests;
    /**
     * Gets the authenticated user from the API guard or the default request.
     */
    protected function authenticatedUser(Request $request): User
    {
        $user = Auth::guard('api')->user() ?? $request->user();

        if (! $user) {
            abort(401, __('auth.Autenticação necessária. Envie o token de autenticação no cabeçalho.'));
        }

        return $user;
    }

    /**
     * Checks whether the user has one of the allowed profiles.
     *
     * @deprecated Use Laravel Policies for access control instead.
     */
    protected function requireRole(User $user, array $roles): void
    {
        if (! $user->profile || ! in_array($user->profile->name, $roles, true)) {
            abort(403, __('common.Acesso proibido para o seu perfil.'));
        }
    }

    /**
     * Returns a formatted JSON response for resource not found.
     */
    protected function jsonNotFound(?string $message = null): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('common.Não encontrado.'),
        ], 404);
    }

    /**
     * Returns a formatted JSON response for manual validation errors.
     */
    protected function jsonValidationError(mixed $errors): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
        ], 422);
    }
}
