<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Resolves the authenticated user from tokens present in the request.
 *
 * The 'api' guard uses the 'token' driver (non-hashed comparison), which does
 * not resolve this application's users (tokens are stored hashed). This service
 * replicates the logic of `CustomAuthMiddleware` for contexts where that middleware
 * does not run (e.g. public language-switch route).
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
