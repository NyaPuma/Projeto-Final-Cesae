<?php

namespace Tests\Unit\DTOs;

use App\DTOs\StoreRoomData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreRoomDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new StoreRoomData(name: 'Laboratório', code: 'LAB-1', location: 'Piso 2');

        $this->assertEquals('Laboratório', $dto->name);
        $this->assertEquals('LAB-1', $dto->code);
        $this->assertEquals('Piso 2', $dto->location);
        $this->assertTrue($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_uppercases_code(): void
    {
        $dto = StoreRoomData::fromRequest([
            'name' => '  Sala A  ',
            'code' => '  lab-1  ',
            'location' => 'R/C',
        ]);

        $this->assertEquals('Sala A', $dto->name);
        $this->assertEquals('LAB-1', $dto->code);
    }

    #[Test]
    public function it_treats_blank_optional_fields_as_null(): void
    {
        $dto = StoreRoomData::fromRequest(['name' => 'Sala', 'code' => '', 'location' => '   ']);

        $this->assertNull($dto->code);
        $this->assertNull($dto->location);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = StoreRoomData::fromRequest(['name' => 'Sala']);

        $this->assertEquals([
            'name' => 'Sala',
            'code' => null,
            'location' => null,
            'active' => true,
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_blank_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreRoomData(name: '');
    }
}
