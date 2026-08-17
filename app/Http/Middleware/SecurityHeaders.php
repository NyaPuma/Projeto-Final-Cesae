<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class SecurityHeaders
{
    /**
     * Handle an incoming request and attach standard security headers to the response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $this->addSecurityHeaders($response, $request);

        return $response;
    }

    /**
     * Adiciona os cabeçalhos de segurança HTTP recomendados à resposta.
     */
    private function addSecurityHeaders(Response $response, Request $request): void
    {
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '0');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        if (! $response->headers->has('Content-Security-Policy')) {
            $response->headers->set('Content-Security-Policy', $this->buildCsp($request));
        }
    }

    /**
     * Constrói a Content Security Policy (CSP) adequada ao ambiente da aplicação.
     */
    private function buildCsp(Request $request): string
    {
        $isDev = app()->environment('local') || config('app.debug', false);

        if ($isDev) {
            return "default-src 'self' http://localhost:5173 http://127.0.0.1:5173 ws://localhost:5173 ws://127.0.0.1:5173; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 http://127.0.0.1:5173 https://cdn.jsdelivr.net blob:; worker-src 'self' http://localhost:5173 http://127.0.0.1:5173 blob:; style-src 'self' 'unsafe-inline' http://localhost:5173 http://127.0.0.1:5173 https://fonts.bunny.net https://cdn.jsdelivr.net; img-src 'self' data:; font-src 'self' data: https://fonts.bunny.net; connect-src 'self' ws://localhost:5173 ws://127.0.0.1:5173 http://localhost:5173 http://127.0.0.1:5173; frame-ancestors 'none'";
        }

        return "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc=' 'sha256-984T+3bISjZF+mcKmtZUkLmqv4c0vAokOJaZPqGd7N0=' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";
    }
}
