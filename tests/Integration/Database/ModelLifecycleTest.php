<?php

namespace Tests\Integration\Database;


use App\Enums\UserRoleEnum;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class ModelLifecycleTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_crud_lifecycle_user(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);

        $password = 'Str0ng!'.uniqid().'#Xx';
        $response = $this->postJson('/admin/users', [
            'name' => 'CRUD Test User',
            'email' => 'crud.test.'.uniqid().'@example.invalid',
            'password' => $password,
            'password_confirmation' => $password,
            'role' => UserRoleEnum::User->value,
            'profile_id' => $profile->id,
        ]);
        $response->assertStatus(201);
        $userId = $response->json('user.id');
        $this->assertDatabaseHas('users', ['id' => $userId]);

        $response = $this->patchJson("/admin/users/{$userId}", [
            'name' => 'Updated CRUD User',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('users', ['id' => $userId, 'name' => 'Updated CRUD User']);
    }

    #[Test]
    public function it_crud_lifecycle_room(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Test Room CRUD',
            'location' => 'Building A',
        ]);
        $response->assertStatus(201);
        $roomId = $response->json('room.id');
        $this->assertDatabaseHas('rooms', ['id' => $roomId]);

        $response = $this->patchJson("/admin/rooms/{$roomId}", [
            'name' => 'Updated Room',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'name' => 'Updated Room']);
    }

    #[Test]
    public function it_inactivates_room_preserving_data(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Inactivate Test',
            'location' => 'Building B',
        ]);
        $roomId = $response->json('room.id');

        $response = $this->patchJson("/admin/rooms/{$roomId}/inactive");
        $response->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $roomId, 'active' => false]);
    }

    #[Test]
    public function it_crud_lifecycle_equipment_with_category(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Eq Room', 'code' => 'RM-'.uniqid(), 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Test Cat', 'active' => true]);

        $response = $this->postJson('/admin/equipment', [
            'name' => 'Test Equipment',
            'serial' => 'EQ-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
        ]);
        $response->assertStatus(201);
        $eqId = $response->json('equipment.id');
        $this->assertDatabaseHas('equipments', [
            'id' => $eqId,
            'category_id' => $category->id,
            'room_id' => $room->id,
        ]);
    }

    #[Test]
    public function it_crud_lifecycle_ticket(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Persistence Test Ticket',
            'description' => 'Full lifecycle test',
            'priority' => 'média',
        ]);
        $response->assertStatus(201);
        $ticketId = $response->json('ticket.id');
        $this->assertDatabaseHas('tickets', ['id' => $ticketId]);

        $response = $this->getJson("/tickets/{$ticketId}");
        $response->assertOk();
    }
}
