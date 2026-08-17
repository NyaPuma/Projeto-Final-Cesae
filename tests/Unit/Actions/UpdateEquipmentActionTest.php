<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateEquipmentAction;
use App\DTOs\UpdateEquipmentData;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class UpdateEquipmentActionTest extends FeatureTestCase
{
    private UpdateEquipmentAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(UpdateEquipmentAction::class);
    }

    #[Test]
    public function it_updates_the_equipment_name(): void
    {
        $equipment = Equipment::factory()->create();

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(name: '  Novo Nome  ')
        );

        $this->assertEquals('Novo Nome', $result->name);
    }

    #[Test]
    public function it_uppercases_and_trims_the_serial_when_provided(): void
    {
        $equipment = Equipment::factory()->create();

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(serial: '  sn-new-0001  ')
        );

        $this->assertEquals('SN-NEW-0001', $result->serial);
    }

    #[Test]
    public function it_keeps_the_existing_serial_when_not_provided(): void
    {
        $equipment = Equipment::factory()->create(['serial' => 'SN-ORIGINAL']);

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(name: 'Renomeado')
        );

        $this->assertEquals('SN-ORIGINAL', $result->serial);
    }

    #[Test]
    public function it_updates_room_and_category_links(): void
    {
        $equipment = Equipment::factory()->create();
        $room = Room::factory()->create();
        $category = EquipmentCategory::factory()->create();

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(roomId: $room->id, categoryId: $category->id)
        );

        $this->assertEquals($room->id, $result->room_id);
        $this->assertEquals($category->id, $result->category_id);
        $this->assertTrue($result->relationLoaded('room'));
        $this->assertTrue($result->relationLoaded('category'));
    }

    #[Test]
    public function it_deactivates_the_equipment_when_requested(): void
    {
        $equipment = Equipment::factory()->create(['active' => true]);

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(active: false)
        );

        $this->assertFalse($result->active);
    }

    #[Test]
    public function it_reactivates_the_equipment_when_requested(): void
    {
        $equipment = Equipment::factory()->create(['active' => false]);

        $result = $this->action->execute(
            $equipment,
            new UpdateEquipmentData(active: true)
        );

        $this->assertTrue($result->active);
    }
}
