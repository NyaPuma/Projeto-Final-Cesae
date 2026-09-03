<?php

namespace Tests\Integration\Database;

use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketComment;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class ForeignKeyIntegrityTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_references_valid_user(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'FK User Test',
            'description' => 'Testing user FK',
            'priority' => 'baixa',
        ]);
        $response->assertStatus(201);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNotNull($ticket->user);
        $this->assertEquals($user->id, $ticket->user_id);
    }

    #[Test]
    public function it_references_valid_status(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'FK Status Test',
            'description' => 'Testing status FK',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $this->assertNotNull($ticket->status);
        $this->assertEquals(TicketStatusEnum::Open->value, $ticket->status->name);
    }

    #[Test]
    public function it_references_valid_ticket_and_user_on_comment(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Comment FK Test',
            'description' => 'Testing comment FKs',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $this->asUserWithToken($technician);
        $response = $this->postJson("/tickets/{$ticketId}/comments", [
            'comment' => 'FK integrity test comment',
        ]);
        $response->assertStatus(201);
        $commentId = $response->json('comment.id');

        $comment = TicketComment::find($commentId);
        $this->assertNotNull($comment->ticket);
        $this->assertNotNull($comment->user);
        $this->assertEquals($ticketId, $comment->ticket_id);
        $this->assertEquals($technician->id, $comment->user_id);
    }

    #[Test]
    public function it_references_valid_room_and_category(): void
    {
        $room = Room::create(['name' => 'FK Room', 'active' => true]);
        $category = EquipmentCategory::create(['name' => 'FK Cat', 'active' => true]);

        $equipment = Equipment::create([
            'name' => 'FK Equipment',
            'serial' => 'FK-'.uniqid(),
            'room_id' => $room->id,
            'category_id' => $category->id,
            'active' => true,
        ]);

        $this->assertNotNull($equipment->room);
        $this->assertNotNull($equipment->category);
        $this->assertEquals($room->id, $equipment->room_id);
        $this->assertEquals($category->id, $equipment->category_id);
    }

    #[Test]
    public function it_references_valid_user_on_notification(): void
    {
        $user = $this->createRegularUser();

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => 'FK Notification Test',
            'message' => 'Test',
            'type' => 'ticket_created',
        ]);

        $this->assertNotNull($notification->user);
        $this->assertEquals($user->id, $notification->user_id);
    }
}
