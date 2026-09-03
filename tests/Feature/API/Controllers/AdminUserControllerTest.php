<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
    }

    private function admin(): User
    {
        return User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    #[Test]
    public function admin_can_list_profiles(): void
    {
        $response = $this->withHeader('X-Auth-Token', $this->admin()->api_token)
            ->getJson('/api/admin/profiles');

        $response->assertOk()
            ->assertJsonStructure(['profiles']);

        $this->assertCount(3, $response->json('profiles'));
    }

    #[Test]
    public function non_admin_cannot_list_profiles(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/admin/profiles');

        $response->assertStatus(403);
    }

    #[Test]
    public function admin_cannot_inactivate_self(): void
    {
        $admin = $this->admin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/users/{$admin->id}/inactive");

        $this->assertContains($response->status(), [403, 422]);
        $this->assertTrue($admin->refresh()->active);
    }

    #[Test]
    public function admin_can_delete_user(): void
    {
        $admin = $this->admin();
        $target = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->deleteJson("/api/admin/users/{$target->id}");

        $response->assertOk();
        $this->assertSoftDeleted('users', ['id' => $target->id]);
    }

    #[Test]
    public function admin_cannot_delete_self(): void
    {
        $admin = $this->admin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->deleteJson("/api/admin/users/{$admin->id}");

        $this->assertContains($response->status(), [403, 422]);
        $this->assertNotSoftDeleted('users', ['id' => $admin->id]);
    }

    #[Test]
    public function admin_can_list_users_with_pagination_metadata(): void
    {
        User::factory()->count(20)->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => fn () => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $this->admin()->api_token)
            ->getJson('/api/admin/users');

        $response->assertOk()
            ->assertJsonStructure([
                'users' => [
                    'data',
                    'meta' => ['current_page', 'last_page', 'total'],
                ],
            ]);

        $this->assertSame(2, $response->json('users.meta.last_page'));
        $this->assertCount(15, $response->json('users.data'));
    }

    #[Test]
    public function admin_can_list_users_respecting_page_param(): void
    {
        User::factory()->count(20)->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => fn () => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $this->admin()->api_token)
            ->getJson('/api/admin/users?page=2');

        $response->assertOk()
            ->assertJsonPath('users.meta.current_page', 2)
            ->assertJsonPath('users.meta.total', 21);
    }

    #[Test]
    public function non_admin_cannot_delete_user(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $target = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::Technician->value)->first()->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->deleteJson("/api/admin/users/{$target->id}");

        $response->assertForbidden();
        $this->assertNotSoftDeleted('users', ['id' => $target->id]);
    }
}
