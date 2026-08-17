<?php

namespace Tests\Security\Headers;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    #[Test]
    public function it_allows_vite_and_fonts_in_development_csp(): void
    {
        Config::set('app.env', 'local');
        Config::set('app.debug', true);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertStringContainsString('http://localhost:5173', $csp,
            'CSP should contain Vite dev server URL for script loading');

        $this->assertStringContainsString('style-src', $csp);
        $this->assertStringContainsString('http://localhost:5173', $csp,
            'CSP should contain Vite dev server URL for style loading');

        $this->assertStringContainsString('ws://localhost:5173', $csp,
            'CSP should contain Vite WebSocket URL for HMR connections');

        $this->assertStringContainsString("'unsafe-eval'", $csp,
            'CSP should allow Alpine expression compilation in development');

        $this->assertStringContainsString('worker-src', $csp,
            'CSP should define worker-src for Vite worker scripts');

        $this->assertStringNotContainsString('[::1]', $csp,
            'CSP should not contain bracketed IPv6 hosts');

        $this->assertStringContainsString('https://fonts.bunny.net', $csp,
            'CSP should contain fonts.bunny.net for font loading');
    }

    #[Test]
    public function it_allows_vite_when_debug_flag_is_true(): void
    {
        Config::set('app.env', 'production');
        Config::set('app.debug', true);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertStringContainsString('http://localhost:5173', $csp,
            'CSP should allow Vite dev server when APP_DEBUG=true');
        $this->assertStringContainsString('ws://localhost:5173', $csp,
            'CSP should allow Vite WebSocket when APP_DEBUG=true');
        $this->assertStringContainsString('https://fonts.bunny.net', $csp,
            'CSP should allow fonts.bunny.net when APP_DEBUG=true');
        $this->assertStringContainsString("'unsafe-eval'", $csp,
            'CSP should allow Alpine expression compilation when APP_DEBUG=true');
        $this->assertStringContainsString('worker-src', $csp,
            'CSP should define worker-src for Vite workers when APP_DEBUG=true');
        $this->assertStringNotContainsString('[::1]', $csp,
            'CSP should not contain bracketed IPv6 hosts when APP_DEBUG=true');
    }

    #[Test]
    public function it_keeps_production_csp_restrictive(): void
    {
        Config::set('app.env', 'production');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $expectedCsp = "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc=' 'sha256-984T+3bISjZF+mcKmtZUkLmqv4c0vAokOJaZPqGd7N0=' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";

        $this->assertEquals($expectedCsp, $csp,
            'Production CSP must match the restrictive policy exactly');
    }

    #[Test]
    public function it_blocks_external_resources_in_production_csp(): void
    {
        Config::set('app.env', 'production');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertStringNotContainsString('http://localhost:5173', $csp,
            'Production CSP must NOT contain Vite dev server URL');
        $this->assertStringNotContainsString('ws://localhost:5173', $csp,
            'Production CSP must NOT contain Vite WebSocket URL');
        $this->assertStringNotContainsString('https://fonts.bunny.net', $csp,
            'Production CSP must NOT contain fonts.bunny.net');
    }

    #[Test]
    public function it_uses_restrictive_csp_in_staging(): void
    {
        Config::set('app.env', 'staging');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $expectedCsp = "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc=' 'sha256-984T+3bISjZF+mcKmtZUkLmqv4c0vAokOJaZPqGd7N0=' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";

        $this->assertEquals($expectedCsp, $csp,
            'Staging CSP must match the restrictive production policy');
    }

    #[Test]
    public function it_maintains_other_security_headers_across_environments(): void
    {
        foreach (['local', 'production'] as $env) {
            Config::set('app.env', $env);
            Config::set('app.debug', $env === 'local');

            $middleware = new SecurityHeaders;
            $request = Request::create('/', 'GET', [], [], [], ['HTTPS' => 'on']);

            $response = $middleware->handle($request, function ($req) {
                return response('OK');
            });

            $this->assertEquals('DENY', $response->headers->get('X-Frame-Options'),
                "X-Frame-Options should be DENY in {$env} environment");
            $this->assertEquals('nosniff', $response->headers->get('X-Content-Type-Options'),
                "X-Content-Type-Options should be nosniff in {$env} environment");
            $this->assertEquals('0', $response->headers->get('X-XSS-Protection'),
                "X-XSS-Protection should be '0' in {$env} environment");
            $this->assertEquals('strict-origin-when-cross-origin', $response->headers->get('Referrer-Policy'),
                "Referrer-Policy should be strict-origin-when-cross-origin in {$env} environment");
            $this->assertEquals('camera=(), microphone=(), geolocation=()', $response->headers->get('Permissions-Policy'),
                "Permissions-Policy should remain unchanged in {$env} environment");
            $this->assertEquals('same-origin', $response->headers->get('Cross-Origin-Opener-Policy'),
                "Cross-Origin-Opener-Policy should be same-origin in {$env} environment");
            $this->assertEquals('max-age=31536000; includeSubDomains', $response->headers->get('Strict-Transport-Security'),
                "HSTS should be set for secure requests in {$env} environment");
        }
    }

    #[Test]
    public function it_does_not_override_preexisting_csp_header(): void
    {
        Config::set('app.env', 'local');
        Config::set('app.debug', true);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $customCsp = "default-src 'none'; script-src 'self'";

        $response = $middleware->handle($request, function ($req) use ($customCsp) {
            $response = response('OK');
            $response->headers->set('Content-Security-Policy', $customCsp);

            return $response;
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertEquals($customCsp, $csp,
            'Middleware should not override pre-existing CSP header');
    }
}
