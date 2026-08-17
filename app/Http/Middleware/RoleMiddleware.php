<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class RoleMiddleware
{
    /**
     * Handle an incoming request and delegate to the next middleware in the chain.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        /** @var User|null $user */
        $user = Auth::user();

        // 1. Verifica se o utilizador está autenticado e ativo
        if (! $user || ! $user->active) {
            return $this->handleUnauthenticated($request);
        }

        // 2. Garante que o utilizador possui um perfil válido atribuído
        if (! $user->profile_id || ! $user->profile?->name) {
            return $this->handleInvalidProfile($request);
        }

        // 3. Verifica se o papel do utilizador está autorizado para a rota
        if (! in_array($user->profile->name, $roles, true)) {
            return $this->handleForbidden($request);
        }

        return $next($request);
    }

    /**
     * Trata o cenário de utilizador não autenticado ou inativo.
     */
    private function handleUnauthenticated(Request $request): Response
    {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => __('auth.Autenticação necessária.'),
            ], 401);
        }

        if ($request->cookies->has('api_token')) {
            return redirect('/ui/login')->withCookie(cookie()->forget('api_token'));
        }

        return redirect('/ui/login');
    }

    /**
     * Trata o cenário de perfil de utilizador inválido ou em falta.
     */
    private function handleInvalidProfile(Request $request): Response
    {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => __('validation.Perfil inválido.'),
            ], 403);
        }

        return redirect('/ui/login');
    }

    /**
     * Trata o cenário de acesso proibido por falta de permissões adequadas.
     */
    private function handleForbidden(Request $request): Response
    {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => __('common.Acesso proibido para o seu perfil.'),
            ], 403);
        }

        return redirect('/ui')->with('error', __('common.Não tem permissões para aceder a esta página.'));
    }
}
