<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session as SessionContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class CsrfMiddleware
{
    public function __construct(
        private readonly SessionContract $session
    ) {}

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldSkipCsrfValidation($request)) {
            return $next($request);
        }

        $token = $this->getCsrfTokenFromRequest($request);

        if (! $token || ! $this->validateCsrfToken($token)) {
            return response()->json([
                'message' => __('CSRF Token inválido ou expirado.'),
                'error_code' => 419,
                'errors' => [
                    '_token' => ['The CSRF token is invalid or has expired.'],
                ],
            ], 419);
        }

        $this->regenerateSessionId();

        return $next($request);
    }

    /**
     * Determina se a validação CSRF deve ser ignorada para o pedido atual.
     */
    protected function shouldSkipCsrfValidation(Request $request): bool
    {
        if ($request->isMethod('GET')) {
            return true;
        }

        if ($request->is('login', 'register')) {
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
        ], true)) {
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

    /**
     * Extrai o token CSRF do pedido (cabeçalho ou sessão).
     */
    protected function getCsrfTokenFromRequest(Request $request): ?string
    {
        $token = $request->header('X-CSRF-Token');

        if ($token && ! empty($this->session->get('_token'))) {
            return $token;
        }

        return $this->session->get('_token');
    }

    /**
     * Valida se o token fornecido corresponde ao armazenado em sessão.
     */
    protected function validateCsrfToken(string $token): bool
    {
        $trimmedToken = trim($token);

        if (empty($trimmedToken)) {
            return false;
        }

        $storedToken = $this->session->get('_token');

        if ($storedToken !== $trimmedToken) {
            Log::debug('CsrfMiddleware - Token mismatch', [
                'provided_token' => substr($trimmedToken, 0, 8) . '...',
                'stored_token' => $storedToken ?: null,
            ]);

            return false;
        }

        return true;
    }

    /**
     * Regenera o ID de sessão para segurança adicional contra fixation attacks.
     */
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
