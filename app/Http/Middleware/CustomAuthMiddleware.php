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

        $token = $request->header('X-Auth-Token')
            ?: $request->bearerToken()
            ?: $request->cookie('api_token')
            ?: $sessionToken;

        $hasCookie = $request->cookies->has('api_token');
        $hasSessionToken = $sessionToken !== '' && $sessionToken !== null;

        if (! is_string($token) || $token === '') {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.',
                    'error_code' => 401,
                ], 401);
            }

            return redirect('/ui/login');
        }

        // Valida o token via hash HMAC-SHA256 e se o utilizador está ativo
        $tokenHash = User::hashToken($token);
        $user = User::with('profile')->where('api_token', $tokenHash)->where('active', true)->first();

        // Fallback: aceitar tokens em plaintext APENAS em ambiente de teste
        // (a factory de testes armazena tokens em plaintext; em produção o login armazena hash)
        if (! $user && app()->environment('testing')) {
            $user = User::with('profile')->where('api_token', $token)->where('active', true)->first();
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
