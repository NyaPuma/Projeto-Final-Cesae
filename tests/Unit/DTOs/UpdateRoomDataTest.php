<?php

namespace Tests\Unit\DTOs;

use App\DTOs\UpdateRoomData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateRoomDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new UpdateRoomData(name: 'Sala B', active: false);

        $this->assertEquals('Sala B', $dto->name);
        $this->assertFalse($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_uppercases_code(): void
    {
        $dto = UpdateRoomData::fromRequest(['code' => '  sala-b  ', 'name' => ' Novo ']);

        $this->assertEquals('SALA-B', $dto->code);
        $this->assertEquals('Novo', $dto->name);
    }

    #[Test]
    public function it_treats_blank_values_as_null(): void
    {
        $dto = UpdateRoomData::fromRequest(['name' => '   ', 'code' => '', 'location' => ' ']);

        $this->assertNull($dto->name);
        $this->assertNull($dto->code);
        $this->assertNull($dto->location);
    }

    #[Test]
    public function it_filters_null_fields_in_to_array(): void
    {
        $dto = UpdateRoomData::fromRequest(['location' => 'Piso 3']);

        $this->assertEquals(['location' => 'Piso 3'], $dto->toArray());
    }

    #[Test]
    public function it_detects_whether_updates_exist(): void
    {
        $this->assertTrue((new UpdateRoomData(location: 'Piso 3'))->hasUpdates());
        $this->assertFalse((new UpdateRoomData)->hasUpdates());
    }

    #[Test]
    public function it_rejects_blank_code(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UpdateRoomData(code: '');
    }
}
