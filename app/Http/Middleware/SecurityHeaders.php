<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        if (! $response->headers->has('Content-Security-Policy')) {
            $isDev = config('app.env', 'production') === 'local' || config('app.debug', false);

            if ($isDev) {
                $csp = "default-src 'self'; script-src 'self' http://localhost:5173 http://[::1]:5173; style-src 'self' 'unsafe-inline' http://localhost:5173 http://[::1]:5173; img-src 'self' data:; font-src 'self' data: https://fonts.bunny.net; connect-src 'self' ws://localhost:5173 ws://[::1]:5173 http://localhost:5173 http://[::1]:5173; frame-ancestors 'none'";
            } else {
                $csp = "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc='; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";
            }

            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
