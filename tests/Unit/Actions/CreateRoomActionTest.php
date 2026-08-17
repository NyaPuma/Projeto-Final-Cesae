<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateRoomAction;
use App\DTOs\StoreRoomData;
use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class CreateRoomActionTest extends FeatureTestCase
{
    private CreateRoomAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(CreateRoomAction::class);
    }

    #[Test]
    public function it_creates_a_room_with_normalized_fields(): void
    {
        $room = $this->action->execute(
            new StoreRoomData(name: '  Laboratório de Física  ', code: ' lab-1 ', location: '  Piso 2  ')
        );

        $this->assertInstanceOf(Room::class, $room);
        $this->assertEquals('Laboratório de Física', $room->name);
        $this->assertEquals('LAB-1', $room->code);
        $this->assertEquals('Piso 2', $room->location);
        $this->assertTrue($room->active);
    }

    #[Test]
    public function it_creates_a_room_without_location(): void
    {
        $room = $this->action->execute(
            new StoreRoomData(name: 'Oficina', code: 'OF-1')
        );

        $this->assertNull($room->location);
    }

    #[Test]
    public function it_creates_an_inactive_room_when_requested(): void
    {
        $room = $this->action->execute(
            new StoreRoomData(name: 'Arrecadação', code: 'ARR-1', active: false)
        );

        $this->assertFalse($room->active);
    }

    #[Test]
    public function it_persists_the_room_in_the_database(): void
    {
        $this->action->execute(
            new StoreRoomData(name: 'Sala de Servidores', code: 'SRV-1')
        );

        $this->assertDatabaseHas('rooms', ['code' => 'SRV-1', 'name' => 'Sala de Servidores']);
    }
}
