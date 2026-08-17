<?php

namespace Tests\Security\Authentication;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class AuthenticationSecurityTest extends FeatureTestCase
{
    private function createProtectedRoute(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-security', function () {
            return response()->json(['message' => 'secure']);
        });
    }

    #[Test]
    public function it_rejects_empty_auth_token(): void
    {
        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', '')
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_rejects_malformed_tokens(): void
    {
        $this->createProtectedRoute();

        $malformedTokens = [
            'not-a-real-token',
            'AAAA',
            str_repeat('A', 60),
            '000000000000000000000000000000000000000000000000000000000000',
            'special!@#$%^&*()chars',
            '<script>alert(1)</script>',
            '../../etc/passwd',
        ];

        foreach ($malformedTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function it_returns_401_when_auth_header_is_missing(): void
    {
        $this->createProtectedRoute();

        $response = $this->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_returns_401_when_wrong_header_name_is_used(): void
    {
        $this->createProtectedRoute();

        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token-Wrong', $user->api_token)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_hides_token_from_json_response(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-user-json', function () {
            return response()->json(['user' => auth()->user()]);
        });

        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-user-json');

        $response->assertOk();
        $response->assertJsonMissing(['api_token' => $user->api_token]);
    }

    #[Test]
    public function it_verifies_token_is_60_characters(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->assertEquals(60, strlen($user->api_token));
    }

    #[Test]
    public function it_verifies_token_is_unique_per_user(): void
    {
        $user1 = $this->createUserWithToken(UserRoleEnum::User->value);
        $user2 = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->assertNotEquals($user1->api_token, $user2->api_token);
    }

    #[Test]
    public function it_invalidates_previous_token_on_login(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'password' => Hash::make('Password123!'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        $oldToken = $user->api_token;
        $this->assertNotEmpty($oldToken);

        $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', $oldToken)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_invalidates_token_on_logout(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/logout');

        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_rejects_repeated_invalid_token_attempts(): void
    {
        $this->createProtectedRoute();

        for ($i = 0; $i < 10; $i++) {
            $response = $this->withHeader('X-Auth-Token', 'invalid-token-'.$i)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function it_rejects_xss_tokens(): void
    {
        $this->createProtectedRoute();

        $xssTokens = [
            '<script>alert("xss")</script>',
            'javascript:alert(1)',
            '{{constructor.constructor("return this")()}}',
        ];

        foreach ($xssTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function it_rejects_sql_injection_tokens(): void
    {
        $this->createProtectedRoute();

        $sqlTokens = [
            "' OR '1'='1",
            "'; DROP TABLE users; --",
            "1' UNION SELECT * FROM users --",
        ];

        foreach ($sqlTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function it_resolves_correct_user_via_api_guard(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-guard', function () {
            return response()->json(['user_id' => Auth::id()]);
        });

        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-guard');

        $response->assertOk()
            ->assertJsonPath('user_id', $user->id);
    }

    #[Test]
    public function it_verifies_security_headers_on_login_page(): void
    {
        $response = $this->get('/ui/login');
        $response->assertStatus(200);

        $headers = $response->headers;

        $xFrame = $headers->get('X-Frame-Options');
        $csp = $headers->get('Content-Security-Policy');
        $xContentType = $headers->get('X-Content-Type-Options');
        $referrer = $headers->get('Referrer-Policy');

        $missing = [];
        if (! $xFrame) {
            $missing[] = 'X-Frame-Options';
        }
        if (! $csp) {
            $missing[] = 'Content-Security-Policy';
        }
        if (! $xContentType) {
            $missing[] = 'X-Content-Type-Options';
        }
        if (! $referrer) {
            $missing[] = 'Referrer-Policy';
        }

        if (! empty($missing)) {
            \Log::warning('T2 â€” Missing security headers on /ui/login', ['missing' => $missing]);
        }

        $this->assertEmpty($missing, 'Missing security headers: '.implode(', ', $missing));
    }

    #[Test]
    public function it_prevents_dot_git_exposure_via_webroot(): void
    {
        $paths = ['/.git/config', '/.git/HEAD', '/.gitignore'];

        foreach ($paths as $path) {
            $response = $this->get($path);
            $status = $response->status();

            if ($status === 200) {
                \Log::critical("T6 â€” EXPOSED: {$path} accessible (HTTP 200)", [
                    'content_preview' => substr($response->content(), 0, 200),
                ]);
            }

            $this->assertNotEquals(200, $status,
                "EXPOSURE: {$path} is publicly accessible (HTTP 200)"
            );
        }

        $this->assertTrue(true, 'T6 .git exposure check completed');
    }

    #[Test]
    public function it_prevents_composer_json_exposure_via_api_path(): void
    {
        $paths = ['/api/composer.json', '/api/.env', '/composer.json'];

        foreach ($paths as $path) {
            $response = $this->get($path);
            $status = $response->status();

            if ($status === 200) {
                \Log::critical("T6 â€” EXPOSED: {$path} accessible (HTTP 200)", []);
            }

            $this->assertNotEquals(200, $status,
                "EXPOSURE: {$path} is publicly accessible (HTTP 200)"
            );
        }

        $this->assertTrue(true, 'T6 file exposure check completed');
    }
}
