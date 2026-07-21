<?php

namespace Tests\Unit;

use App\Models\Room;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed lookup data
        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_creates_room_with_valid_data(): void
    {
        $room = Room::create([
            'name'     => 'Sala Principal',
            'location' => 'Piso 2, Edifício A',
            'active'   => true,
        ]);

        $this->assertNotNull($room->id);
        $this->assertEquals('Sala Principal', $room->name);
        $this->assertEquals('Piso 2, Edifício A', $room->location);
        $this->assertTrue($room->active);
    }

    #[Test]
    public function it_has_many_equipments(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();

        Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
            'name'        => 'Equipment 1',
        ]);

        Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
            'name'        => 'Equipment 2',
        ]);

        $this->assertCount(2, $room->equipments);
        $this->assertInstanceOf(Equipment::class, $room->equipments->first());
    }

    #[Test]
    public function it_has_many_tickets(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        Ticket::create([
            'title'       => 'Ticket Room 1',
            'description' => 'First room ticket',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'room_id'     => $room->id,
            'equipment_id'=> $equipment->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        Ticket::create([
            'title'       => 'Ticket Room 2',
            'description' => 'Second room ticket',
            'priority'    => Ticket::PRIORITY_HIGH,
            'user_id'     => $user->id,
            'room_id'     => $room->id,
            'equipment_id'=> $equipment->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $this->assertCount(2, $room->tickets);
        $this->assertInstanceOf(Ticket::class, $room->tickets->first());
    }

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $room = new Room();
        $fillable = $room->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('location', $fillable);
        $this->assertContains('active', $fillable);
    }

    #[Test]
    public function it_casts_active_to_boolean(): void
    {
        $room = Room::factory()->create(['active' => 1]);
        $this->assertTrue($room->active);

        $room2 = Room::factory()->create(['active' => 0]);
        $this->assertFalse($room2->active);
    }

    #[Test]
    public function it_can_have_equipments_without_room_deletion(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);

        $this->assertNotNull($equipment->room);
        $this->assertEquals($room->id, $equipment->room->id);
    }
}
