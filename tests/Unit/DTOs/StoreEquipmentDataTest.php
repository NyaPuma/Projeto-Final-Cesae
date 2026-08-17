<?php

namespace Tests\Unit\DTOs;

use App\DTOs\StoreEquipmentData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreEquipmentDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new StoreEquipmentData(name: 'Impressora', serial: 'PRN-001', roomId: 2, categoryId: 3);

        $this->assertEquals('Impressora', $dto->name);
        $this->assertEquals('PRN-001', $dto->serial);
        $this->assertEquals(2, $dto->roomId);
        $this->assertEquals(3, $dto->categoryId);
        $this->assertTrue($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_normalizes_serial(): void
    {
        $dto = StoreEquipmentData::fromRequest([
            'name' => '  Portátil  ',
            'serial' => '  lt-2026  ',
        ]);

        $this->assertEquals('Portátil', $dto->name);
        $this->assertEquals('LT-2026', $dto->serial);
    }

    #[Test]
    public function it_treats_invalid_ids_as_null(): void
    {
        $dto = StoreEquipmentData::fromRequest([
            'name' => 'Teste',
            'serial' => 'X',
            'room_id' => '0',
            'category_id' => '',
        ]);

        $this->assertNull($dto->roomId);
        $this->assertNull($dto->categoryId);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = StoreEquipmentData::fromRequest(['name' => 'Teste', 'serial' => 'x', 'active' => '0']);

        $this->assertFalse($dto->active);
        $this->assertEquals([
            'name' => 'Teste',
            'serial' => 'X',
            'room_id' => null,
            'category_id' => null,
            'active' => false,
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_blank_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreEquipmentData(name: ' ', serial: 'ABC');
    }

    #[Test]
    public function it_rejects_blank_serial(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreEquipmentData(name: 'Teste', serial: '');
    }

    #[Test]
    public function it_rejects_non_positive_room_id(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreEquipmentData(name: 'Teste', serial: 'ABC', roomId: -2);
    }
}
