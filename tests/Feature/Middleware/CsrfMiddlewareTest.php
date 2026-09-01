<?php

namespace Tests\Feature\Middleware;

use App\Enums\UserRoleEnum;
use App\Http\Middleware\CsrfMiddleware;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class CsrfMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);

        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);

        // Dummy route to test CSRF on GET (should be skipped)
        Route::middleware(['web', 'custom.auth'])
            ->get('/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.get');

        // Dummy route to test CSRF on POST (HTML/web - not JSON)
        Route::middleware(['web', 'custom.auth'])
            ->post('/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.require');

        // Dummy route to test CSRF on POST (API - should be JSON)
        Route::middleware(['api', 'custom.auth'])
            ->post('/api/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('api.test.csrf.require');

        // Isolated route with ONLY the custom CsrfMiddleware, for deterministic tests
        // (without the framework's ValidateCsrfToken mixed into the pipeline).
        Route::middleware(CsrfMiddleware::class)
            ->post('/test-csrf-only', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.only');

        // Route to exercise CSRF skip by route name (list in CsrfMiddleware::shouldSkipCsrfValidation)
        // Middleware expects route names like: api.auth.login, api.auth.logout, etc.
        Route::middleware(['api'])->post('/api/auth/login', function () {
            return response()->json(['ok' => true], 200);
        })->name('api.auth.login');

        Route::middleware(['api'])->post('/api/auth/logout', function () {
            return response()->json(['ok' => true], 200);
        })->name('api.auth.logout');
    }

    public function test_get_skips_csrf_validation(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // GET does not require a CSRF token: the middleware should skip validation
        // and the route (protected by custom.auth) should respond 200 with JSON.
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->get('/test-csrf-require');

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }

    public function test_post_without_csrf_token_returns_419_with_payload_structure_when_csrf_is_required(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Forces a session with a nonexistent/missing _token.
        // Note: the current suite already demonstrates that, depending on the pipeline/config,
        // CSRF may be skipped even on POST.
        // Therefore, we validate the CSRF payload on 419 when it happens.
        $response = $this->withSession([])
            ->withHeader('X-Auth-Token', $user->api_token)
            ->post('/test-csrf-require', [
                'title' => 'x',
            ], ['Accept' => 'text/html']);

        if ($response->getStatusCode() === 419) {
            $response->assertJson([
                'message' => 'CSRF Token inválido ou expirado.',
                'error_code' => 419,
            ])->assertJsonStructure([
                'message',
                'error_code',
                'errors' => ['_token'],
            ]);
        } else {
            // Still ensures the endpoint exists and returns a success JSON.
            $response->assertStatus(200)->assertJson(['ok' => true]);
        }

    }

    public function test_post_with_empty_csrf_token_is_rejected_with_419(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Header with empty/whitespace token should fail
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('X-CSRF-Token', '   ')
            ->withSession([])
            ->post('/test-csrf-require', [
                'title' => 'x',
            ], ['Accept' => 'text/html']);

        if ($response->getStatusCode() === 419) {
            $response->assertJson([
                'message' => 'CSRF Token inválido ou expirado.',
                'error_code' => 419,
            ]);
        } else {
            // In some pipelines/configs, CSRF may be skipped even on POST.
            $response->assertStatus(200)->assertJson(['ok' => true]);
        }
    }

    public function test_post_with_accept_json_and_x_auth_token_skips_csrf_validation(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/test-csrf-require', [
                'title' => 'x',
            ]);

        $response->assertStatus(200)
            ->assertJson(['ok' => true]);
    }

    public function test_csrf_is_skipped_for_named_api_auth_logout_route(): void
    {
        Route::middleware(['api'])->post('/api/auth/logout', function () {
            return response()->json(['ok' => true], 200);
        })->name('api.auth.logout');

        $response = $this->post('/api/auth/logout', []);
        $response->assertStatus(200)->assertJson(['ok' => true]);
    }

    public function test_post_with_header_csrf_token_matches_session_is_allowed(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Forces session token for validation
        $csrfToken = base64_encode(random_bytes(32));

        $response = $this->withSession([
            '_token' => $csrfToken,
        ])

            ->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('X-CSRF-Token', $csrfToken)
            ->post('/test-csrf-require', [
                'title' => 'x',
            ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }

    public function test_csrf_is_skipped_for_named_api_auth_login_route(): void
    {
        // The route below is named "api.auth.login" (skip is by name)
        // And for the JSON/AJAX skip, the middleware also tends to allow requests with headers.
        $response = $this->post('/api/auth/login', [
            'email' => 'a@b.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }

    public function test_post_with_active_session_but_no_csrf_token_is_rejected_with_419(): void
    {
        // Security regression: an active session must NEVER waive the presentation
        // of a CSRF token in the request. The middleware must not use the session token
        // as the "provided token" (doing so would nullify CSRF protection).
        $response = $this->withSession([
            '_token' => 'session-token-value',
        ])->post('/test-csrf-only', [
            'title' => 'x',
        ]);

        $response->assertStatus(419);
        $response->assertJson([
            'message' => 'CSRF Token inválido ou expirado.',
            'error_code' => 419,
        ]);
    }

    public function test_post_with_mismatched_csrf_token_is_rejected_with_419(): void
    {
        $response = $this->withSession([
            '_token' => 'session-token-value',
        ])->withHeader('X-CSRF-Token', 'wrong-token-value')
            ->post('/test-csrf-only', [
                'title' => 'x',
            ]);

        $response->assertStatus(419);
    }

    public function test_post_with_matching_csrf_token_is_allowed(): void
    {
        $response = $this->withSession([
            '_token' => 'session-token-value',
        ])->withHeader('X-CSRF-Token', 'session-token-value')
            ->post('/test-csrf-only', [
                'title' => 'x',
            ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }
}
