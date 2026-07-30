<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
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

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
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

    // â”€â”€â”€ User CRUD â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function test_admin_can_create_user(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->first();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/users', [
                'name' => 'New User',
                'email' => 'newuser@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => UserRoleEnum::User->value,
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
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/admin/users', [
                'name' => 'Unauthorized User',
                'email' => 'unauth@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'profile_id' => 1,
            ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $targetUser = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/users/{$targetUser->id}", [
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
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $targetUser = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/users/{$targetUser->id}/inactive");

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'active' => 0,
        ]);
    }

    // â”€â”€â”€ Equipment CRUD â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function test_admin_can_create_equipment(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Server Room', 'location' => 'Floor 2', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/equipment', [
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
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Workshop A', 'location' => 'Ground Floor', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Old Drill',
            'serial' => 'DRL-001',
            'room_id' => $room->id,
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
    ->patchJson("/api/admin/equipment/{$equipment->id}", [
        'name' => 'Updated Drill Press',
        'category_id' => $equipment->category_id,
        'room_id' => $equipment->room_id,
    ]);

        $response->assertOk();
        $this->assertDatabaseHas('equipments', [
            'id' => $equipment->id,
            'name' => 'Updated Drill Press',
        ]);
    }

    public function test_admin_can_delete_equipment(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Storage', 'location' => 'Basement', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Old Machine',
            'serial' => 'OLD-999',
            'room_id' => $room->id,
            'active' => false,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->deleteJson("/api/admin/equipment/{$equipment->id}");

        $response->assertOk();
        $this->assertSoftDeleted('equipments', ['id' => $equipment->id]);
    }

    // â”€â”€â”€ Room CRUD â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function test_admin_can_create_room(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/rooms', [
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
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Old Lab', 'location' => 'Floor 1', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$room->id}", [
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
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Decommissioned Room', 'location' => 'Floor 5', 'active' => true]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$room->id}/inactive");

        $response->assertOk();
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'active' => 0,
        ]);
    }
}
