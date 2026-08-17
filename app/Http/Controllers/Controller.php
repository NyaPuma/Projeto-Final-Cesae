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
     * Obtém o utilizador autenticado a partir do guard API ou da request padrão.
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
     * Verifica se o utilizador possui um dos perfis permitidos.
     *
     * @deprecated Recomenda-se a utilização de Policies do Laravel para controlo de acessos.
     */
    protected function requireRole(User $user, array $roles): void
    {
        if (! $user->profile || ! in_array($user->profile->name, $roles, true)) {
            abort(403, __('common.Acesso proibido para o seu perfil.'));
        }
    }

    /**
     * Retorna uma resposta JSON formatada para recurso não encontrado.
     */
    protected function jsonNotFound(?string $message = null): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('common.Não encontrado.'),
        ], 404);
    }

    /**
     * Retorna uma resposta JSON formatada para erros de validação manuais.
     */
    protected function jsonValidationError(mixed $errors): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
        ], 422);
    }
}
