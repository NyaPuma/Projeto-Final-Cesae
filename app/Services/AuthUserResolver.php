<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Resolve o utilizador autenticado a partir dos tokens presentes no pedido.
 *
 * O guard 'api' usa o driver 'token' (comparação sem hash), que não resolve
 * os utilizadores desta aplicação (os tokens são guardados com hash). Este
 * serviço replica a lógica do `CustomAuthMiddleware` para contextos onde esse
 * middleware não corre (ex.: rota pública de troca de idioma).
 */
final class AuthUserResolver
{
    public static function fromRequest(Request $request): ?User
    {
        $tokens = array_filter([
            $request->header('X-Auth-Token'),
            $request->bearerToken(),
            $request->cookie('api_token'),
            $request->cookie('auth_token'),
            $request->hasSession() ? $request->session()->get('api_token') : null,
        ], fn ($v) => is_string($v) && $v !== '');

        foreach ($tokens as $token) {
            $found = User::where('api_token', User::hashToken($token))
                ->where('active', true)
                ->whereNull('deleted_at')
                ->first();

            if (! $found && app()->environment('testing')) {
                $found = User::where('api_token', $token)
                    ->where('active', true)
                    ->whereNull('deleted_at')
                    ->first();
            }

            if ($found) {
                return $found;
            }
        }

        return null;
    }
}
