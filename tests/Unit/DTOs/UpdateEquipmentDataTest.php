<?php

namespace Tests\Unit\DTOs;

use App\DTOs\UpdateEquipmentData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateEquipmentDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new UpdateEquipmentData(name: 'Scanner', active: false);

        $this->assertEquals('Scanner', $dto->name);
        $this->assertFalse($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_uppercases_serial(): void
    {
        $dto = UpdateEquipmentData::fromRequest(['serial' => '  sn-x  ', 'name' => ' Novo ']);

        $this->assertEquals('SN-X', $dto->serial);
        $this->assertEquals('Novo', $dto->name);
    }

    #[Test]
    public function it_treats_blank_values_as_null(): void
    {
        $dto = UpdateEquipmentData::fromRequest(['name' => ' ', 'serial' => '', 'room_id' => '']);

        $this->assertNull($dto->name);
        $this->assertNull($dto->serial);
        $this->assertNull($dto->roomId);
    }

    #[Test]
    public function it_filters_null_fields_in_to_array(): void
    {
        $dto = UpdateEquipmentData::fromRequest(['name' => 'Novo']);

        $this->assertEquals(['name' => 'Novo'], $dto->toArray());
    }

    #[Test]
    public function it_detects_whether_updates_exist(): void
    {
        $this->assertTrue((new UpdateEquipmentData(name: 'Novo'))->hasUpdates());
        $this->assertFalse((new UpdateEquipmentData())->hasUpdates());
    }

    #[Test]
    public function it_rejects_blank_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UpdateEquipmentData(name: '');
    }

    #[Test]
    public function it_rejects_non_positive_category_id(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UpdateEquipmentData(categoryId: 0);
    }
}
