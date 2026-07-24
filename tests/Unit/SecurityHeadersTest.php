<?php

namespace Tests\Unit;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    /**
     * Bug Condition Exploration Test
     * 
     * **Property 1: Bug Condition** - Development Resources Blocked by CSP
     * 
     * **Validates: Requirements 2.1, 2.2, 2.3**
     * 
     * CRITICAL: This test MUST FAIL on unfixed code - failure confirms the bug exists.
     * When this test passes after the fix, it confirms the expected behavior is satisfied.
     * 
     * This test verifies that in development environment (APP_ENV=local OR APP_DEBUG=true),
     * the CSP policy should allow:
     * - Vite dev server resources (http://[::1]:5173) in script-src and style-src
     * - Vite WebSocket connections (ws://[::1]:5173) in connect-src
     * - fonts.bunny.net resources in font-src and style-src
     * 
     * On UNFIXED code, this test will FAIL because the current hardcoded CSP blocks these resources.
     */
    public function test_development_csp_allows_vite_and_fonts()
    {
        // Set development environment
        Config::set('app.env', 'local');
        Config::set('app.debug', true);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        // Assert Vite dev server is allowed in script-src
        $this->assertStringContainsString('http://localhost:5173', $csp, 
            'CSP should contain Vite dev server URL for script loading');
        
        // Assert Vite dev server is allowed in style-src
        $this->assertStringContainsString('style-src', $csp);
        $this->assertStringContainsString('http://localhost:5173', $csp,
            'CSP should contain Vite dev server URL for style loading');
        
        // Assert Vite WebSocket is allowed in connect-src
        $this->assertStringContainsString('ws://localhost:5173', $csp,
            'CSP should contain Vite WebSocket URL for HMR connections');
        
        // Assert fonts.bunny.net is allowed in font-src
        $this->assertStringContainsString('https://fonts.bunny.net', $csp,
            'CSP should contain fonts.bunny.net for font loading');
    }

    /**
     * Additional test case: Verify development CSP with only APP_DEBUG=true
     */
    public function test_development_csp_with_debug_flag()
    {
        // Set production environment but debug=true
        Config::set('app.env', 'production');
        Config::set('app.debug', true);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        // Should still get development CSP when debug is true
        $this->assertStringContainsString('http://localhost:5173', $csp,
            'CSP should allow Vite dev server when APP_DEBUG=true');
        $this->assertStringContainsString('ws://localhost:5173', $csp,
            'CSP should allow Vite WebSocket when APP_DEBUG=true');
        $this->assertStringContainsString('https://fonts.bunny.net', $csp,
            'CSP should allow fonts.bunny.net when APP_DEBUG=true');
    }

    /**
     * Preservation Property Test
     * 
     * **Property 2: Preservation** - Production Security Maintained
     * 
     * **Validates: Requirements 3.1, 3.2, 3.3**
     * 
     * This test verifies that in production environment (APP_ENV != 'local' AND APP_DEBUG != true),
     * the CSP policy remains exactly as the original restrictive policy.
     * 
     * On UNFIXED code, this test should PASS, confirming the baseline behavior to preserve.
     */
    public function test_production_csp_remains_restrictive()
    {
        // Set production environment
        Config::set('app.env', 'production');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        // Expected production CSP with SHA-256 hash
        $expectedCsp = "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc='; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";

        $this->assertEquals($expectedCsp, $csp,
            'Production CSP must match the restrictive policy exactly');
    }

    /**
     * Preservation Property Test - No External Domains in Production
     * 
     * **Property 2: Preservation** - Production Security Maintained
     * 
     * **Validates: Requirements 3.1, 3.2**
     * 
     * Verifies that production CSP does NOT contain external domains like Vite dev server or font CDNs.
     */
    public function test_production_csp_blocks_external_resources()
    {
        // Set production environment
        Config::set('app.env', 'production');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        // Assert external resources are NOT allowed
        $this->assertStringNotContainsString('http://localhost:5173', $csp,
            'Production CSP must NOT contain Vite dev server URL');
        $this->assertStringNotContainsString('ws://localhost:5173', $csp,
            'Production CSP must NOT contain Vite WebSocket URL');
        $this->assertStringNotContainsString('https://fonts.bunny.net', $csp,
            'Production CSP must NOT contain fonts.bunny.net');
    }

    /**
     * Preservation Property Test - Staging Environment
     * 
     * **Property 2: Preservation** - Production Security Maintained
     * 
     * **Validates: Requirements 3.1, 3.3**
     * 
     * Verifies that staging environment also gets restrictive CSP (not development CSP).
     */
    public function test_staging_environment_uses_restrictive_csp()
    {
        // Set staging environment
        Config::set('app.env', 'staging');
        Config::set('app.debug', false);

        $middleware = new SecurityHeaders;
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $csp = $response->headers->get('Content-Security-Policy');

        $expectedCsp = "default-src 'self'; script-src 'self' 'sha256-yUJBAWN3tbQhmB6geMpw+PgJT0sHuIV6UyRTt6U8Lyc='; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'";

        $this->assertEquals($expectedCsp, $csp,
            'Staging CSP must match the restrictive production policy');
    }

    /**
     * Preservation Property Test - All Non-CSP Security Headers
     * 
     * **Property 2: Preservation** - Production Security Maintained
     * 
     * **Validates: Requirement 3.3**
     * 
     * Verifies that all other security headers remain unchanged regardless of environment.
     */
    public function test_other_security_headers_remain_unchanged()
    {
        // Test in both development and production
        foreach (['local', 'production'] as $env) {
            Config::set('app.env', $env);
            Config::set('app.debug', $env === 'local');

            $middleware = new SecurityHeaders;
            $request = Request::create('/', 'GET', [], [], [], ['HTTPS' => 'on']);

            $response = $middleware->handle($request, function ($req) {
                return response('OK');
            });

            // Verify all non-CSP security headers
            $this->assertEquals('DENY', $response->headers->get('X-Frame-Options'),
                "X-Frame-Options should be DENY in {$env} environment");
            $this->assertEquals('nosniff', $response->headers->get('X-Content-Type-Options'),
                "X-Content-Type-Options should be nosniff in {$env} environment");
            $this->assertEquals('1; mode=block', $response->headers->get('X-XSS-Protection'),
                "X-XSS-Protection should be '1; mode=block' in {$env} environment");
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

    /**
     * Preservation Property Test - CSP Override Preservation
     * 
     * **Property 2: Preservation** - Production Security Maintained
     * 
     * **Validates: Requirement 3.3**
     * 
     * Verifies that middleware respects pre-existing CSP headers and doesn't override them.
     */
    public function test_respects_existing_csp_header()
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

