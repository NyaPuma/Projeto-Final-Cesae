<?php

namespace Tests\Integration\Database;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class SoftDeleteTest extends FeatureTestCase
{
    use InteractsWithApi;

    #[Test]
    public function it_soft_deletes_ticket_preserving_record(): void
    {
        $user = $this->createRegularUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Soft Delete Test',
            'description' => 'Should be soft deleted',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->delete();

        $this->assertSoftDeleted('tickets', ['id' => $ticketId]);

        $ticketFromDb = Ticket::withTrashed()->find($ticketId);
        $this->assertNotNull($ticketFromDb);
        $this->assertNotNull($ticketFromDb->deleted_at);
    }

    #[Test]
    public function it_cascades_soft_delete_nullifying_equipment_room_id(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/admin/rooms', [
            'name' => 'Cascade Room',
            'location' => 'Test',
        ]);
        $roomId = $response->json('room.id');

        $this->postJson('/admin/equipment', [
            'name' => 'Cascade Equipment',
            'serial' => 'CAS-'.uniqid(),
            'room_id' => $roomId,
        ]);

        $room = Room::find($roomId);
        $room->delete();

        $this->assertSoftDeleted('rooms', ['id' => $roomId]);

        $equipment = Equipment::where('room_id', $roomId)->first();
        $this->assertNotNull($equipment->room_id, 'Equipment room_id preserved after soft delete');
    }
}
