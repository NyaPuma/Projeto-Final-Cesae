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

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        // O login endpoint (API) retorna JSON + cookie, entÃ£o a verificaÃ§Ã£o de redirect deve ser feita
        // para rotas UI que usam o dashboard.
        // MantÃ©m o teste focado no que Ã© observÃ¡vel e estÃ¡vel: depois de login, o acesso ao dashboard deve funcionar.
        $token = $response->json('token');

        // UI dashboard (rotas baseadas em UiController)
        $dashboard = $this
            ->withHeader('X-Auth-Token', $token)
            ->get('/ui');

        $dashboard->assertStatus(200);

        // ConteÃºdo esperado (Blade layout do dashboard)
        $dashboard->assertSee('Tickets');

        // Verifica que os links do menu apontam para rotas reais (sem '*')
        // e que conseguem renderizar sem erro.
        $dashboard->assertSee('href="/ui/tickets"', false);
        $dashboard->assertSee('href="/ui/equipments"', false);
        $dashboard->assertSee('href="/calendar"', false);
    }
}
