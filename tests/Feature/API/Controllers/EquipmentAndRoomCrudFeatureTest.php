<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EquipmentAndRoomCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_perform_full_crud_on_rooms()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        // Create Room
        $response = $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/rooms', [
                'name' => 'Sala 101',
                'location' => 'Bloco A',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('room.name', 'Sala 101');

        $roomId = $response->json('room.id');

        // Update Room
        $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$roomId}", [
                'name' => 'Sala 101 Modificada',
            ])
            ->assertStatus(200)
            ->assertJsonPath('room.name', 'Sala 101 Modificada');

        // Inactivate Room
        $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$roomId}/inactive")
            ->assertStatus(200);

        $this->assertDatabaseHas('rooms', [
            'id' => $roomId,
            'active' => false,
        ]);
    }

    public function test_admin_can_perform_crud_on_equipment()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        $room = Room::factory()->create();

        // Create Equipment linked to optional room
        $response = $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/equipment', [
                'name' => 'Torno Mecânico X1',
                'serial' => 'SN-99887766',
                'room_id' => $room->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('equipment.name', 'Torno Mecânico X1')
            ->assertJsonPath('equipment.room_id', $room->id);

        $equipId = $response->json('equipment.id');

        // Delete Equipment
        $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->deleteJson("/api/admin/equipment/{$equipId}")
            ->assertStatus(200);

        $this->assertSoftDeleted('equipments', [
            'id' => $equipId,
        ]);
    }

    public function test_admin_can_list_equipments_with_resource_structure()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        $room = Room::factory()->create();
        Equipment::factory()->count(2)->create(['room_id' => $room->id]);

        $response = $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/admin/equipment');

        $response->assertOk()
            ->assertJsonStructure(['equipments']);

        $this->assertCount(2, $response->json('equipments'));
    }

    public function test_store_equipment_validation_errors(): void
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        $room = Room::factory()->create();

        $send = fn (array $payload) => $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/equipment', $payload);

        // Missing required fields
        $send([])->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'serial']);

        // Non-existent room_id
        $send(['name' => 'Impressora', 'serial' => 'SN-VALID-1', 'room_id' => 99999])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['room_id']);

        // duplicate serial
        Equipment::factory()->create(['serial' => 'SN-DUP-1', 'room_id' => $room->id]);
        $send(['name' => 'Impressora', 'serial' => 'SN-DUP-1'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['serial']);

        // Non-boolean active
        $send(['name' => 'Impressora', 'serial' => 'SN-VALID-2', 'active' => 'yes'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['active']);
    }

    public function test_store_room_validation_errors(): void
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $send = fn (array $payload) => $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/rooms', $payload);

        // Missing required fields
        $send([])->assertStatus(422)->assertJsonValidationErrors(['name']);

        // Duplicate name
        Room::factory()->create(['name' => 'Sala Duplicada']);
        $send(['name' => 'Sala Duplicada'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);

        // Name with only spaces collapses to empty
        $send(['name' => '   '])->assertStatus(422)->assertJsonValidationErrors(['name']);

        // location above 255 characters
        $send(['name' => 'Sala Nova', 'location' => str_repeat('a', 256)])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['location']);
    }

    public function test_update_room_validation_errors(): void
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        /** @var User $admin */
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $room = Room::factory()->create(['name' => 'Sala A']);
        Room::factory()->create(['name' => 'Sala B']);

        $send = fn (array $payload) => $this->actingAs($admin)
            ->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$room->id}", $payload);

        // Keeping its own name is accepted (ignore works)
        $send(['name' => 'Sala A'])->assertOk();

        // Name of another room → 422
        $send(['name' => 'Sala B'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);

        // location above 255 characters
        $send(['location' => str_repeat('a', 256)])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['location']);
    }
}
