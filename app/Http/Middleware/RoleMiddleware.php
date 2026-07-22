<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request and delegate to the next middleware in the chain.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles The roles that are allowed to access this route
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Se por algum motivo o utilizador não estiver autenticado nesta requisição
        if (!$user || !$user->active) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Autenticação necessária.',
                ], 401);
            }

            // Se veio de um cookie (Web), limpa o cookie inválido e redireciona
            if ($request->cookies->has('api_token')) {
                return redirect('/ui/login')->withCookie(cookie()->forget('api_token'));
            }

            return redirect('/ui/login');
        }

        // Garante que o utilizador tem um perfil válido atribuído
        if (!$user->profile) {
            $defaultProfile = UserProfile::where('name', User::ROLE_USER)->first();

            if ($defaultProfile && !$user->profile_id) {
                $user->update(['profile_id' => $defaultProfile->id]);
                // Recarrega a relação para atualizar o objeto em memória
                $user->load('profile');
            } else {
                if ($request->expectsJson() || $request->wantsJson()) {
                    return response()->json([
                        'message' => 'Perfil inválido.',
                    ], 403);
                }
                return redirect('/ui/login');
            }
        }

        // Verifica se o cargo do utilizador está incluído nos cargos permitidos para esta rota
        if (!in_array($user->profile->name, $roles)) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Acesso proibido para o seu perfil.',
                ], 403);
            }

            // Se for na Interface Web, redireciona para a Dashboard geral com um aviso
            return redirect('/ui')->with('error', 'Não tem permissões para aceder a esta página.');
        }

        return $next($request);
    }
}
