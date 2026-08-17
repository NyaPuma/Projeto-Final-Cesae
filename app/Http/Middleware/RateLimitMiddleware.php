<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class RateLimitMiddleware
{
    /**
     * Create a new middleware instance.
     */
    public function __construct(
        private readonly RateLimiter $limiter
    ) {}

    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string $maxAttempts = '60',
        int $decayMinutes = 1
    ): Response {
        $maxAttemptsInt = (int) $maxAttempts;
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttemptsInt)) {
            return $this->buildResponse($key, $maxAttemptsInt, $decayMinutes);
        }

        // Regista a tentativa atual no limitador de taxa
        $this->limiter->hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $maxAttemptsInt,
            $this->calculateRemainingAttempts($key, $maxAttemptsInt)
        );
    }

    /**
     * Resolve a assinatura única do pedido para efeitos de limite de taxa.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        if ($this->isAuthEndpoint($request)) {
            $email = (string) $request->input('email', '');

            return sha1($request->ip() . '|' . $email);
        }

        // Para outros endpoints, usar IP + user_id (se autenticado) ou 'guest'
        $user = $request->user();
        $userId = $user ? (string) $user->id : 'guest';

        return sha1($request->ip() . '|' . $userId . '|' . $request->path());
    }

    /**
     * Determina se o pedido atinge um endpoint de autenticação
     * (login, registo ou recuperação de password) para o qual o
     * limite deve ser aplicado por IP + email.
     */
    protected function isAuthEndpoint(Request $request): bool
    {
        if ($request->is('login', 'register')) {
            return true;
        }

        $routeName = (string) ($request->route()?->getName() ?? '');

        return $routeName === 'api.login' || Str::startsWith($routeName, 'api.password.');
    }

    /**
     * Adiciona os cabeçalhos informativos de limite de taxa à resposta.
     */
    protected function addHeaders(Response $response, int $maxAttempts, int $remainingAttempts): Response
    {
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);

        return $response;
    }

    /**
     * Calcula o número de tentativas restantes permitidas.
     */
    protected function calculateRemainingAttempts(string $key, int $maxAttempts): int
    {
        return max(0, $maxAttempts - $this->limiter->attempts($key));
    }

    /**
     * Constrói a resposta a retornar quando o limite de taxa é excedido.
     */
    protected function buildResponse(string $key, int $maxAttempts, int $decayMinutes): Response
    {
        $retryAfter = $this->limiter->availableIn($key);

        $response = response()->json([
            'message' => __('common.Demasiadas tentativas. Tente novamente mais tarde.'),
            'retry_after' => $retryAfter,
        ], 429);

        $response->headers->set('Retry-After', $retryAfter);

        return $this->addHeaders($response, $maxAttempts, 0);
    }
}
