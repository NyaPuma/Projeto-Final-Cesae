<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    // ─── User CRUD ───────────────────────────────────────────────────────

    public function test_admin_can_create_user(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $userProfile = UserProfile::where('name', User::ROLE_USER)->first();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/users', [
                'name' => 'New User',
                'email' => 'newuser@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'profile_id' => $userProfile->id,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'name' => 'New User',
        ]);
    }

    public function test_non_admin_cannot_create_user(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/admin/users', [
                'name' => 'Unauthorized User',
                'email' => 'unauth@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'profile_id' => 1,
            ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $targetUser = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/users/{$targetUser->id}", [
                'name' => 'Updated Name',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_admin_can_inactivate_user(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $targetUser = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/users/{$targetUser->id}/inactive");

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'active' => 0,
        ]);
    }

    // ─── Equipment CRUD ──────────────────────────────────────────────────

    public function test_admin_can_create_equipment(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $room = Room::create(['name' => 'Server Room', 'location' => 'Floor 2', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/equipment', [
                'name' => 'New CNC Machine',
                'serial' => 'CNC-2024-001',
                'room_id' => $room->id,
                'active' => true,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('equipments', [
            'name' => 'New CNC Machine',
            'serial' => 'CNC-2024-001',
        ]);
    }

    public function test_admin_can_update_equipment(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $room = Room::create(['name' => 'Workshop A', 'location' => 'Ground Floor', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Old Drill',
            'serial' => 'DRL-001',
            'room_id' => $room->id,
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/equipment/{$equipment->id}", [
                'name' => 'Updated Drill Press',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('equipments', [
            'id' => $equipment->id,
            'name' => 'Updated Drill Press',
        ]);
    }

    public function test_admin_can_delete_equipment(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $room = Room::create(['name' => 'Storage', 'location' => 'Basement', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Old Machine',
            'serial' => 'OLD-999',
            'room_id' => $room->id,
            'active' => false,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->deleteJson("/admin/equipment/{$equipment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('equipments', ['id' => $equipment->id]);
    }

    // ─── Room CRUD ───────────────────────────────────────────────────────

    public function test_admin_can_create_room(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/rooms', [
                'name' => 'New Laboratory',
                'location' => 'Floor 4, Building B',
                'active' => true,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rooms', [
            'name' => 'New Laboratory',
        ]);
    }

    public function test_admin_can_update_room(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $room = Room::create(['name' => 'Old Lab', 'location' => 'Floor 1', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/rooms/{$room->id}", [
                'name' => 'Renovated Lab',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'name' => 'Renovated Lab',
        ]);
    }

    public function test_admin_can_inactivate_room(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $room = Room::create(['name' => 'Decommissioned Room', 'location' => 'Floor 5', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/rooms/{$room->id}/inactive");

        $response->assertOk();
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'active' => 0,
        ]);
    }
}
