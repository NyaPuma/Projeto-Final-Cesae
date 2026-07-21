<?php

namespace Tests\Unit;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EquipmentTest extends TestCase
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
    public function it_creates_equipment_with_valid_data(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();

        $equipment = Equipment::create([
            'name'        => 'Test Machine',
            'serial'      => 'SN-12345',
            'room_id'     => $room->id,
            'category_id' => $category->id,
            'active'      => true,
        ]);

        $this->assertNotNull($equipment->id);
        $this->assertEquals('Test Machine', $equipment->name);
        $this->assertEquals('SN-12345', $equipment->serial);
        $this->assertTrue($equipment->active);
    }

    #[Test]
    public function it_belongs_to_a_category(): void
    {
        $category = EquipmentCategory::factory()->create(['name' => 'Elétrica']);
        $room = Room::factory()->create();

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);

        $this->assertInstanceOf(EquipmentCategory::class, $equipment->category);
        $this->assertEquals('Elétrica', $equipment->category->name);
    }

    #[Test]
    public function it_belongs_to_a_room(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create(['name' => 'Sala A1', 'location' => 'Piso 1']);

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);

        $this->assertInstanceOf(Room::class, $equipment->room);
        $this->assertEquals('Sala A1', $equipment->room->name);
    }

    #[Test]
    public function it_has_many_tickets(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);

        Ticket::create([
            'title'       => 'Ticket 1',
            'description' => 'First ticket',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'equipment_id'=> $equipment->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        Ticket::create([
            'title'       => 'Ticket 2',
            'description' => 'Second ticket',
            'priority'    => Ticket::PRIORITY_HIGH,
            'user_id'     => $user->id,
            'equipment_id'=> $equipment->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $this->assertCount(2, $equipment->tickets);
        $this->assertInstanceOf(Ticket::class, $equipment->tickets->first());
    }

    #[Test]
    public function it_inactive_by_default(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
        ]);

        $this->assertIsBool($equipment->active);
    }

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $equipment = new Equipment();
        $fillable = $equipment->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('serial', $fillable);
        $this->assertContains('room_id', $fillable);
        $this->assertContains('category_id', $fillable);
        $this->assertContains('active', $fillable);
    }

    #[Test]
    public function it_has_correct_table_name(): void
    {
        $equipment = new Equipment();
        $this->assertEquals('equipments', $equipment->getTable());
    }

    #[Test]
    public function it_casts_active_to_boolean(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'room_id'     => $room->id,
            'active'      => 1,
        ]);

        $this->assertTrue($equipment->active);
    }
}
