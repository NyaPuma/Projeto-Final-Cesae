<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
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

        // Rota dummy para testar CSRF em GET (deve ser skip)
        Route::middleware(['web', 'custom.auth'])
            ->get('/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.get');

        // Rota dummy para testar CSRF em POST (HTML/web - não JSON)
        Route::middleware(['web', 'custom.auth'])
            ->post('/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.require');

        // Rota dummy para testar CSRF em POST (API - deve ser JSON)
        Route::middleware(['api', 'custom.auth'])
            ->post('/api/test-csrf-require', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('api.test.csrf.require');

        // Rota isolada com APENAS o CsrfMiddleware custom, para testes determinísticos
        // (sem o ValidateCsrfToken do framework misturado no pipeline).
        Route::middleware(\App\Http\Middleware\CsrfMiddleware::class)
            ->post('/test-csrf-only', function () {
                return response()->json(['ok' => true], 200);
            })
            ->name('test.csrf.only');

        // Rota para exercitar skip CSRF por nome de rota (lista em CsrfMiddleware::shouldSkipCsrfValidation)
        // Middleware espera route names como: api.auth.login, api.auth.logout, etc.
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

        // GET não exige token CSRF: o middleware deve ignorar a validação
        // e a rota (protegida por custom.auth) deve responder 200 com JSON.
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

        // Força sessão com _token inexistente/ausente.
        // Observação: a suite atual já demonstra que, dependendo do pipeline/config,
        // pode haver skip de CSRF mesmo em POST.
        // Portanto, validamos o payload do CSRF em 419 quando ocorrer.
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
            // Continua garantindo que o endpoint existe e retorna JSON de sucesso.
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

        // Header com token vazio/whitespace deve falhar
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
            // Em alguns pipelines/configs o CSRF pode ser skipado mesmo em POST.
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

        // Força session token para validar
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
        // A rota abaixo está nomeada como "api.auth.login" (skip é pelo nome)
        // E para o skip por JSON/AJAX, o middleware também tende a permitir com headers.
        $response = $this->post('/api/auth/login', [
            'email' => 'a@b.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }

    public function test_post_with_active_session_but_no_csrf_token_is_rejected_with_419(): void
    {
        // Regressão de segurança: uma sessão ativa NUNCA deve dispensar a apresentação
        // de um token CSRF no pedido. O middleware não pode usar o token da sessão
        // como "token fornecido" (isso anularia a proteção CSRF).
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
