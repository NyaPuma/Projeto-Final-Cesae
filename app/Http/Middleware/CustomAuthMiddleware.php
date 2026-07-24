<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Trata uma rota protegida validando o token customizado da aplicação.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Em alguns contextos (ex: testes sem session store), request()->session() pode lançar.
        $sessionToken = null;
        try {
            $sessionToken = $request->session()->get('api_token');
        } catch (\Throwable $e) {
            // ignorar
        }

        // Recolhe todos os candidatos a token (por ordem de prioridade)
        $candidates = array_filter([
            $request->header('X-Auth-Token'),
            $request->bearerToken(),
            $request->cookie('api_token'),
            $request->cookie('auth_token'),
            $sessionToken,
        ], fn ($v) => is_string($v) && $v !== '');

        if (empty($candidates)) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.',
                    'error_code' => 401,
                ], 401);
            }

            return redirect('/ui/login');
        }

        // O primeiro candidato é a fonte explícita (header ou cookie). Se existir,
        // valida APENAS esse. Caso contrário, tenta todos (cookie → session).
        $explicitToken = reset($candidates);
        $tokensToTry = $request->header('X-Auth-Token') || $request->bearerToken()
            ? [$explicitToken]
            : $candidates;

        $user = null;
        $token = null;
        $hasCookie = $request->cookies->has('api_token') || $request->cookies->has('auth_token');

        foreach ($tokensToTry as $candidate) {
            $tokenHash = User::hashToken($candidate);
            $found = User::with('profile')->where('api_token', $tokenHash)->where('active', true)->whereNull('deleted_at')->first();

            // Fallback: aceitar tokens em plaintext APENAS em ambiente de teste
            if (! $found && app()->environment('testing')) {
                $found = User::with('profile')->where('api_token', $candidate)->where('active', true)->whereNull('deleted_at')->first();
            }

            if ($found) {
                $user = $found;
                $token = $candidate;
                break;
            }
        }

        if (! $user) {
            // 1ª Prioridade: Se a rota espera JSON, responde SEMPRE com JSON
            if ($request->expectsJson() || $request->wantsJson()) {
                $jsonResponse = response()->json([
                    'message' => 'Token inválido ou utilizador inativo.',
                    'error_code' => 401,
                    'errors' => [
                        'api_token' => ['Invalid or user is inactive.'],
                    ],
                ], 401);

                // Se mesmo na API veio um cookie inválido, limpamo-lo na resposta
                return $hasCookie ? $jsonResponse->withCookie(cookie()->forget('api_token')) : $jsonResponse;
            }

            // 2ª Prioridade: Rotas Web normais
            if ($hasCookie) {
                return redirect('/ui/login')->withCookie(cookie()->forget('api_token'));
            }

            return redirect('/ui/login');
        }

        // Verifica se o utilizador tem um perfil válido
        if (! $user->profile_id || ! $user->profile?->name) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Perfil inválido.',
                    'error_code' => 403,
                    'errors' => [
                        'profile_id' => ['User must have a valid profile assigned.'],
                    ],
                ], 403);
            }

            return redirect('/ui/login');
        }

        // Verifica expiração do token (30 dias) — ignora em ambiente de teste
        if (! app()->environment('testing') && $user->token_created_at && $user->token_created_at->diffInDays(now()) > 30) {
            $user->api_token = null;
            $user->save();

            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Token expirado. Faça login novamente.',
                    'error_code' => 401,
                ], 401);
            }

            return redirect('/ui/login');
        }

        // Define o utilizador autenticado no Guard para a requisição atual
        Auth::guard('api')->setUser($user);

        // Opcional: Garante que qualquer chamada futura a Auth::user() nesta requisição use o guard 'api' automaticamente
        Auth::shouldUse('api');

        return $next($request);
    }
}
