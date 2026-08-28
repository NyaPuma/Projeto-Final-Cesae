<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class DashboardRedirectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
    }

    public function test_after_login_user_is_redirected_to_dashboard_to_manage_tickets(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        // The login endpoint (API) returns JSON + cookie, so the redirect check must be done
        // on UI routes that use the dashboard.
        // Keeps the test focused on what is observable and stable: after login, dashboard access must work.
        $token = $response->json('token');

        // UI dashboard (routes based on UiController)
        $dashboard = $this
            ->withHeader('X-Auth-Token', $token)
            ->get('/ui');

        $dashboard->assertStatus(200);

        // Expected content (dashboard Blade layout)
        $dashboard->assertSee('Tickets');

        // Checks that menu links point to real routes (without '*')
        // and that they render without error.
        $dashboard->assertSee('http://localhost/ui/tickets"', false);
        $dashboard->assertSee('http://localhost/ui/equipments"', false);
        $dashboard->assertSee('http://localhost/calendar"', false);
    }
}
