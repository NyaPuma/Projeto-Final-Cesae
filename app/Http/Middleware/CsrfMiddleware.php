<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session as SessionContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CsrfMiddleware
{
    protected SessionContract $session;

    public function __construct(SessionContract $session)
    {
        $this->session = $session;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldSkipCsrfValidation($request)) {
            return $next($request);
        }

        $token = $this->getCsrfTokenFromRequest($request);

        if (! $token || ! $this->validateCsrfToken($token)) {
            return response()->json([
                'message' => 'CSRF Token inválido ou expirado.',
                'error_code' => 419,
                'errors' => [
                    '_token' => ['The CSRF token is invalid or has expired.'],
                ],
            ], 419);
        }

        $this->regenerateSessionId();

        return $next($request);
    }

    protected function shouldSkipCsrfValidation(Request $request): bool
    {
        if ($request->isMethod('GET')) {
            return true;
        }

        if ($request->is('login') || $request->is('register')) {
            return true;
        }

        $route = $request->route();
        $routeName = $route ? ($route->getName() ?? '') : '';

        if (in_array($routeName, [
            'api.auth.login',
            'api.auth.logout',
            'api.user.profile.update',
            'api.ticket.create',
            'api.equipment.create',
            'api.notification.create',
        ])) {
            $token = $request->header('X-Auth-Token') ?: $request->bearerToken();

            if ($token && ! empty($this->session->get('_token'))) {
                return true;
            }
        }

        if ($routeName !== '' && Str::startsWith(strtolower($routeName), ['api.admin', 'api.analytics'])) {
            $token = $request->header('X-Admin-Token') ?: $request->bearerToken();

            if (! empty($token)) {
                return true;
            }
        }

        if ($routeName !== '' && Str::startsWith(strtolower($routeName), ['api.health', 'api.status'])) {
            return true;
        }

        return false;
    }

    protected function getCsrfTokenFromRequest(Request $request): ?string
    {
        $token = $request->header('X-CSRF-Token');

        if ($token && ! empty($this->session->get('_token'))) {
            return $token;
        }

        return $this->session->get('_token') ?: null;
    }

    protected function validateCsrfToken(string $token): bool
    {
        if (empty(trim($token))) {
            return false;
        }

        $storedToken = $this->session->get('_token');

        if ($storedToken !== trim($token)) {
            Log::debug('CsrfMiddleware - Token mismatch', [
                'provided_token' => substr(trim($token), 0, 8).'...',
                'stored_token' => $storedToken ?: null,
            ]);

            return false;
        }

        return true;
    }

    protected function regenerateSessionId(): void
    {
        $token = $this->session->get('_token');

        if ($token && ! empty($this->session->getId())) {
            try {
                $this->session->regenerate();
            } catch (\Exception $e) {
                Log::error('CsrfMiddleware - Failed to regenerate session ID', [
                    'exception' => $e->getMessage(),
                ]);
            }
        }
    }
}
