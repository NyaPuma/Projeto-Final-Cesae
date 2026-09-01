<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create necessary profiles for tests
        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);

        // Seed ticket statuses if not already done
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);

        // custom.auth mutates the default guard to 'api' globally; reset it so
        // actingAs() (web guard) works deterministically in standalone tests.
        Auth::shouldUse('web');
    }

    #[Test]
    public function it_allows_access_when_user_has_valid_token_and_correct_role()
    {
        // Create user with technician profile and API token
        $userProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);

        // Create a protected route that requires technician role only
        Route::middleware(['custom.auth', 'role:technician'])->get('/protected-technician', function () {
            return response()->json([
                'message' => 'Access granted to technician.',
            ], 200);
        })->name('test.protected.technician');

        // Make request with valid token and correct role (technician)
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-technician');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Access granted to technician.']);
    }

    #[Test]
    public function it_denies_access_when_user_has_invalid_role()
    {
        // Create user with admin profile but route requires only technician role
        $userProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);

        // Create a protected route that requires technician role only
        Route::middleware(['custom.auth', 'role:technician'])->get('/protected-technician', function () {
            return response()->json([
                'message' => 'Access granted to technician.',
            ], 200);
        })->name('test.protected.technician');

        // Make request with valid token but incorrect role (admin instead of technician)
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-technician');

        $response->assertStatus(403);
        $response->assertJson([
            'message' => 'Acesso proibido para o seu perfil.',
        ]);
    }

    #[Test]
    public function it_denies_access_when_user_has_invalid_token()
    {
        // Create a protected route that requires technician role only
        Route::middleware(['custom.auth', 'role:technician'])->get('/protected-technician', function () {
            return response()->json([
                'message' => 'Access granted to technician.',
            ], 200);
        })->name('test.protected.technician');

        // Make request with invalid token
        $response = $this->withHeader('X-Auth-Token', 'invalid-token')
            ->getJson('/protected-technician');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Token inválido ou utilizador inativo.',
        ]);
    }

    #[Test]
    public function it_denies_access_when_user_is_not_active()
    {
        // Create user with technician profile but inactive status
        $userProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
            'active' => false,
        ]);

        // Create a protected route that requires technician role only
        Route::middleware(['custom.auth', 'role:technician'])->get('/protected-technician', function () {
            return response()->json([
                'message' => 'Access granted to technician.',
            ], 200);
        })->name('test.protected.technician');

        // Make request with token from inactive user
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-technician');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Token inválido ou utilizador inativo.',
        ]);
    }

    #[Test]
    public function it_denies_access_when_user_has_no_profile()
    {
        // Create user without profile_id (simulating missing profile)
        $user = User::factory()->create([
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);
        DB::table('users')->where('id', $user->id)->update(['profile_id' => null]);

        // Create a protected route that requires technician role only
        Route::middleware(['custom.auth', 'role:technician'])->get('/protected-technician', function () {
            return response()->json([
                'message' => 'Access granted to technician.',
            ], 200);
        })->name('test.protected.technician');

        // Make request with token from user without profile
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-technician');

        $response->assertStatus(403);
        $response->assertJson([
            'message' => 'Perfil inválido.',
        ]);
    }

    #[Test]
    public function it_allows_access_when_user_has_multiple_roles()
    {
        // Create user with technician profile and API token
        $userProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);

        // Create a protected route that allows both technician and admin roles
        Route::middleware(['custom.auth', 'role:technician,admin'])->get('/protected-multi', function () {
            return response()->json([
                'message' => 'Access granted.',
            ], 200);
        })->name('test.protected.multi');

        // Make request with valid token and correct role (technician)
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-multi');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_allows_access_when_user_has_admin_role()
    {
        // Create user with admin profile and API token
        $userProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);

        // Create a protected route that allows admin role only
        Route::middleware(['custom.auth', 'role:admin'])->get('/protected-admin', function () {
            return response()->json([
                'message' => 'Access granted to admin.',
            ], 200);
        })->name('test.protected.admin');

        // Make request with valid token and correct role (admin)
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-admin');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_allows_access_when_user_has_no_role()
    {
        // Create user with technician profile and API token
        $userProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => bin2hex(random_bytes(32)), // Generate random token
        ]);

        // Create a protected route that allows all roles (no restrictions)
        Route::middleware(['custom.auth', 'role:user,technician,admin'])->get('/protected-all', function () {
            return response()->json([
                'message' => 'Access granted.',
            ], 200);
        })->name('test.protected.all');

        // Make request with valid token and correct role (user)
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/protected-all');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_rejects_unauthenticated_requests_when_used_standalone()
    {
        Route::middleware(['role:admin'])->get('/standalone-role', function () {
            return response()->json(['message' => 'Access granted.']);
        })->name('test.standalone.role');

        $response = $this->getJson('/standalone-role');

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Autenticação necessária.']);
    }

    #[Test]
    public function it_rejects_users_without_profile_when_used_standalone()
    {
        Route::middleware(['role:admin'])->get('/standalone-role', function () {
            return response()->json(['message' => 'Access granted.']);
        })->name('test.standalone.role');

        $user = User::factory()->create([
            'api_token' => bin2hex(random_bytes(32)),
            'active' => true,
        ]);
        DB::table('users')->where('id', $user->id)->update(['profile_id' => null]);
        $user->refresh();

        /** @var Authenticatable $user */
        $response = $this->actingAs($user)->getJson('/standalone-role');

        $response->assertStatus(403);
        $response->assertJson(['message' => 'Perfil inválido.']);
    }

    #[Test]
    public function it_allows_access_when_used_standalone_with_authenticated_user()
    {
        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->firstOrFail();

        /** @var Authenticatable $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'active' => true,
        ]);

        Route::middleware(['role:admin'])->get('/standalone-role', function () {
            return response()->json(['message' => 'Access granted.']);
        })->name('test.standalone.role');

        $response = $this->actingAs($admin)->getJson('/standalone-role');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_redirects_web_requests_to_login_when_unauthenticated()
    {
        Route::middleware(['role:admin'])->get('/standalone-role-web', function () {
            return response()->json(['message' => 'Access granted.']);
        })->name('test.standalone.role.web');

        $response = $this->get('/standalone-role-web');

        $response->assertRedirect('/ui/login');
    }
}
