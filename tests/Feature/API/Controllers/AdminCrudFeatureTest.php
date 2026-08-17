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
            'profile_id' => $userProfile->id,
        ]);
    }

    public function test_admin_can_create_technician_with_specific_profile(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $techProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/users', [
                'name' => 'New Technician',
                'email' => 'newtech@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'profile_id' => $techProfile->id,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'newtech@example.com',
            'name' => 'New Technician',
            'profile_id' => $techProfile->id,
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

    public function test_admin_can_update_user_keeping_same_email(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $targetUser = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/users/{$targetUser->id}", [
                'name' => 'Updated Name',
                'email' => $targetUser->email,
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

    public function test_update_equipment_validation_errors(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $room = Room::create(['name' => 'Workshop B', 'location' => 'Floor 1', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Printer',
            'serial' => 'PRN-UPD-1',
            'room_id' => $room->id,
            'active' => true,
        ]);
        Equipment::create([
            'name' => 'Other',
            'serial' => 'PRN-OTHER-1',
            'room_id' => $room->id,
            'active' => true,
        ]);

        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/equipment/{$equipment->id}", $payload);

        // Manter o próprio serial é aceite (ignore funciona)
        $send(['serial' => 'PRN-UPD-1'])->assertOk();

        // Serial de outro equipamento → 422
        $send(['serial' => 'PRN-OTHER-1'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['serial']);

        // room_id inexistente → 422
        $send(['room_id' => 99999])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['room_id']);

        // active não booleano → 422
        $send(['active' => 'maybe'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['active']);
    }

    public function test_store_user_validation_errors(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->first();

        $base = [
            'name' => 'Novo Utilizador',
            'email' => 'user-novo@example.com',
            'password' => 'Password123!',
            'profile_id' => $userProfile->id,
        ];

        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/users', $payload);

        // Campos obrigatórios em falta
        $send([])->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password', 'profile_id']);

        // Email duplicado
        $userProfile2 = UserProfile::where('name', UserRoleEnum::User->value)->first();
        User::factory()->create([
            'profile_id' => $userProfile2->id,
            'email' => 'duplicado@example.com',
            'active' => true,
        ]);
        $send(array_merge($base, ['email' => 'duplicado@example.com']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // profile_id inexistente
        $send(array_merge($base, ['profile_id' => 99999]))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['profile_id']);

        // Password fraca
        $send(array_merge($base, ['password' => 'short']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        // active não booleano
        $send(array_merge($base, ['active' => 'yes']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['active']);
    }

    public function test_update_user_validation_errors(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->first();
        $target = $this->createUserWithToken(UserRoleEnum::User->value);

        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/users/{$target->id}", $payload);

        // Email de outro utilizador → 422
        $other = $this->createUserWithToken(UserRoleEnum::User->value);
        $send(['email' => $other->email])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // profile_id inexistente → 422
        $send(['profile_id' => 99999])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['profile_id']);

        // password fraca → 422
        $send(['password' => 'short'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        // active não booleano → 422
        $send(['active' => 'yes'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['active']);

        // name só-espaços → 422
        $send(['name' => '   '])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }
}
