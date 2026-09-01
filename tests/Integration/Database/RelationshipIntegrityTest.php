<?php

namespace Tests\Integration\Database;

use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketStatus;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class RelationshipIntegrityTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_user_has_many_tickets(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        for ($i = 0; $i < 3; $i++) {
            $this->postJson('/api/tickets', [
                'title' => "Multi Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
            ]);
        }

        $this->assertEquals(3, $user->tickets()->count());
    }

    #[Test]
    public function it_ticket_has_many_comments(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/api/tickets', [
            'title' => 'Comment Rel Test',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($technician);
        $this->postJson("/api/tickets/{$ticketId}/comments", ['comment' => 'First']);
        $this->postJson("/api/tickets/{$ticketId}/comments", ['comment' => 'Second']);

        $ticket = Ticket::find($ticketId);
        $this->assertEquals(2, $ticket->comments()->count());
    }

    #[Test]
    public function it_ticket_belongs_to_status(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/api/tickets', [
            'title' => 'Status Rel Test',
            'description' => 'Test',
            'priority' => 'média',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::with('status')->find($ticketId);
        $this->assertNotNull($ticket->status);
        $this->assertEquals('aberta', $ticket->status->name);
    }

    #[Test]
    public function it_ticket_belongs_to_equipment_and_room(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $room = Room::create(['name' => 'Rel Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Rel Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Rel Equipment',
            'serial' => 'REL-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
            'active' => true,
        ]);

        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/api/tickets', [
            'title' => 'Equipment Rel Test',
            'description' => 'Test',
            'priority' => 'alta',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::with(['equipment', 'room'])->find($ticketId);
        $this->assertEquals($equipment->id, $ticket->equipment_id);
        $this->assertEquals($room->id, $ticket->room_id);
        $this->assertNotNull($ticket->equipment);
        $this->assertNotNull($ticket->room);
    }

    #[Test]
    public function it_user_profile_relationship(): void
    {
        $admin = $this->createAdmin();
        $admin->load('profile');

        $this->assertNotNull($admin->profile);
        $this->assertEquals(UserRoleEnum::Admin->value, $admin->profile->name);
    }

    #[Test]
    public function it_user_is_admin_check(): void
    {
        $admin = $this->createAdmin();
        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isTechnician());
        $this->assertFalse($admin->isCommonUser());
    }

    #[Test]
    public function it_user_is_technician_check(): void
    {
        $technician = $this->createTechnician();
        $this->assertTrue($technician->isTechnician());
        $this->assertFalse($technician->isAdmin());
        $this->assertFalse($technician->isCommonUser());
    }

    #[Test]
    public function it_equipment_belongs_to_category(): void
    {
        $category = EquipmentCategory::create(['name' => 'Rel Test Cat', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Rel Cat Equipment',
            'serial' => 'RCAT-'.uniqid(),
            'category_id' => $category->id,
            'active' => true,
        ]);

        $equipment->load('category');
        $this->assertNotNull($equipment->category);
        $this->assertEquals($category->id, $equipment->category_id);
    }

    #[Test]
    public function it_category_has_many_equipments(): void
    {
        $category = EquipmentCategory::create(['name' => 'HasMany Cat', 'active' => true]);

        for ($i = 0; $i < 3; $i++) {
            Equipment::create([
                'name' => "Cat Equipment {$i}",
                'serial' => 'HM-CAT-'.uniqid("-{$i}"),
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(3, $category->equipments()->count());
    }

    #[Test]
    public function it_room_has_many_equipments(): void
    {
        $room = Room::create(['name' => 'HasMany Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'Room Eq Cat', 'active' => true]);

        for ($i = 0; $i < 2; $i++) {
            Equipment::create([
                'name' => "Room Equipment {$i}",
                'serial' => 'HM-ROOM-'.uniqid("-{$i}"),
                'room_id' => $room->id,
                'category_id' => $category->id,
                'active' => true,
            ]);
        }

        $this->assertEquals(2, $room->equipments()->count());
    }

    #[Test]
    public function it_room_has_many_tickets(): void
    {
        $room = Room::create(['name' => 'Ticket Room', 'active' => true]);
        $user = $this->createRegularUser();

        $openStatus = TicketStatus::where('name', 'aberta')->first();

        for ($i = 0; $i < 2; $i++) {
            Ticket::create([
                'title' => "Room Ticket {$i}",
                'description' => 'Test',
                'priority' => 'baixa',
                'user_id' => $user->id,
                'room_id' => $room->id,
                'status_id' => $openStatus->id,
                'opened_at' => now(),
            ]);
        }

        $this->assertEquals(2, $room->tickets()->count());
    }

    #[Test]
    public function it_attachment_belongs_to_ticket_and_user(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/api/tickets', [
            'title' => 'Attachment Test Ticket',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');
        $user = $this->createRegularUser();

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticketId,
            'user_id' => $user->id,
            'file_name' => 'test.jpg',
            'path' => 'ticket_photos/test.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ]);

        $this->assertNotNull($attachment->user);
        $this->assertEquals($user->id, $attachment->user_id);
        $this->assertNotNull($attachment->ticket);
        $this->assertEquals($ticketId, $attachment->ticket_id);
    }
}
