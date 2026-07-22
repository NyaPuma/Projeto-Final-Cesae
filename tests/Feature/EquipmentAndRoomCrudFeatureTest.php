<?php

namespace Tests\Feature;

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
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        // Create Room
        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/rooms', [
                'name' => 'Sala 101',
                'location' => 'Bloco A',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('room.name', 'Sala 101');

        $roomId = $response->json('room.id');

        // Update Room
        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->patchJson("/api/admin/rooms/{$roomId}", [
                'name' => 'Sala 101 Modificada',
            ])
            ->assertStatus(200)
            ->assertJsonPath('room.name', 'Sala 101 Modificada');

        // Inactivate Room
        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->patchJson("/api/admin/rooms/{$roomId}/inactive")
            ->assertStatus(200);

        $this->assertDatabaseHas('rooms', [
            'id' => $roomId,
            'active' => false,
        ]);
    }

    public function test_admin_can_perform_crud_on_equipment()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        $room = Room::factory()->create();

        // Create Equipment linked to optional room
        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
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
        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->deleteJson("/api/admin/equipment/{$equipId}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('equipments', [
            'id' => $equipId,
        ]);
    }
}
