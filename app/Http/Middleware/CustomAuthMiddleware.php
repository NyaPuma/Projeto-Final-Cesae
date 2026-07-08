<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Trata uma rota protegida validando o token customizado da aplicação.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Procura pelo token no cabeçalho customizado ou no padrão Bearer
        $token = $request->header('X-Auth-Token') ?: $request->bearerToken();

        if (!is_string($token) || $token === '') {
            return response()->json([
                'message' => 'Autenticação necessária. Envie X-Auth-Token no cabeçalho.'
            ], 401);
        }

        // Valida o token e se o utilizador está ativo
        $user = User::where('api_token', $token)->where('active', true)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Token inválido ou utilizador inativo.'
            ], 401);
        }

        // Define o utilizador no Request para ficar disponível globalmente via $request->user() ou auth()->user()
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
