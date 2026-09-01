<?php

namespace Tests\Feature\Web\Controllers;

use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class RoomControllerTest extends FeatureTestCase
{
    #[Test]
    public function admin_can_list_rooms(): void
    {
        Room::factory()->count(2)->create();
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/admin/rooms');

        $response->assertOk()
            ->assertJsonStructure(['rooms']);

        $this->assertCount(2, $response->json('rooms'));
    }

    #[Test]
    public function admin_creates_room_with_auto_generated_code(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/rooms', [
                'name' => 'Laboratório de Física',
                'location' => 'Bloco A',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('room.name', 'Laboratório de Física')
            ->assertJsonPath('room.location', 'Bloco A');

        $code = $response->json('room.code');
        $this->assertNotNull($code);
        $this->assertNotEquals('', $code);
        $this->assertStringStartsWith('RM-', $code);
    }

    #[Test]
    public function admin_cannot_create_room_with_duplicate_name(): void
    {
        Room::factory()->create(['name' => 'Sala Única']);
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/rooms', [
                'name' => 'Sala Única',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    #[Test]
    public function admin_can_update_room_keeping_own_name(): void
    {
        $room = Room::factory()->create(['name' => 'Sala Original']);
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$room->id}", [
                'name' => 'Sala Original',
                'location' => 'Novo Local',
            ]);

        $response->assertOk()
            ->assertJsonPath('room.name', 'Sala Original')
            ->assertJsonPath('room.location', 'Novo Local');
    }

    #[Test]
    public function admin_can_inactivate_room(): void
    {
        $room = Room::factory()->create(['active' => true]);
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/api/admin/rooms/{$room->id}/inactive");

        $response->assertOk();
        $this->assertFalse($room->fresh()->active);
    }

    #[Test]
    public function technician_can_list_but_not_create_rooms(): void
    {
        $technician = $this->createTechnician();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/rooms')
            ->assertOk();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/api/rooms', ['name' => 'Sala Técnico'])
            ->assertForbidden();
    }

    #[Test]
    public function regular_user_cannot_list_rooms(): void
    {
        $user = $this->createRegularUser();

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/rooms')
            ->assertForbidden();
    }

    #[Test]
    public function guest_cannot_access_room_endpoints(): void
    {
        $this->getJson('/api/admin/rooms')->assertUnauthorized();
        $this->postJson('/api/admin/rooms', ['name' => 'Sala'])->assertUnauthorized();
    }
}
