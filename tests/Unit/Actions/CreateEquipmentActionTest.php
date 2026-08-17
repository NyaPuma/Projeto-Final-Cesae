<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateEquipmentAction;
use App\DTOs\StoreEquipmentData;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class CreateEquipmentActionTest extends FeatureTestCase
{
    private CreateEquipmentAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(CreateEquipmentAction::class);
    }

    #[Test]
    public function it_creates_equipment_with_trimmed_name(): void
    {
        $equipment = $this->action->execute(
            new StoreEquipmentData(name: '  Compressor AR-90  ', serial: 'SN-1234')
        );

        $this->assertInstanceOf(Equipment::class, $equipment);
        $this->assertEquals('Compressor AR-90', $equipment->name);
        $this->assertDatabaseHas('equipments', ['id' => $equipment->id, 'name' => 'Compressor AR-90']);
    }

    #[Test]
    public function it_stores_the_serial_uppercased_and_trimmed(): void
    {
        $equipment = $this->action->execute(
            new StoreEquipmentData(name: 'Bomba', serial: '  sn-9999  ')
        );

        $this->assertEquals('SN-9999', $equipment->serial);
    }

    #[Test]
    public function it_creates_equipment_without_room_or_category(): void
    {
        $equipment = $this->action->execute(
            new StoreEquipmentData(name: 'Ventilador', serial: 'SN-0001')
        );

        $this->assertNull($equipment->room_id);
        $this->assertNull($equipment->category_id);
        $this->assertTrue($equipment->active);
    }

    #[Test]
    public function it_links_the_equipment_to_room_and_category(): void
    {
        $room = Room::factory()->create();
        $category = EquipmentCategory::factory()->create();

        $equipment = $this->action->execute(
            new StoreEquipmentData(name: 'Gerador', serial: 'SN-7777', roomId: $room->id, categoryId: $category->id)
        );

        $this->assertEquals($room->id, $equipment->room_id);
        $this->assertEquals($category->id, $equipment->category_id);
        $this->assertTrue($equipment->relationLoaded('room'));
        $this->assertTrue($equipment->relationLoaded('category'));
    }

    #[Test]
    public function it_creates_inactive_equipment_when_requested(): void
    {
        $equipment = $this->action->execute(
            new StoreEquipmentData(name: 'Bomba antiga', serial: 'SN-0002', active: false)
        );

        $this->assertFalse($equipment->active);
    }
}
