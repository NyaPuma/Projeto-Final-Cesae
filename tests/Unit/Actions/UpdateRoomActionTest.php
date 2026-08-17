<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateRoomAction;
use App\DTOs\UpdateRoomData;
use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class UpdateRoomActionTest extends FeatureTestCase
{
    private UpdateRoomAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(UpdateRoomAction::class);
    }

    #[Test]
    public function it_updates_the_room_name_and_location(): void
    {
        $room = Room::factory()->create();

        $result = $this->action->execute(
            $room,
            new UpdateRoomData(name: '  Laboratório Novo  ', location: '  Piso 3  ')
        );

        $this->assertEquals('Laboratório Novo', $result->name);
        $this->assertEquals('Piso 3', $result->location);
    }

    #[Test]
    public function it_uppercases_the_code_when_provided(): void
    {
        $room = Room::factory()->create();

        $result = $this->action->execute(
            $room,
            new UpdateRoomData(code: ' lab-x  ')
        );

        $this->assertEquals('LAB-X', $result->code);
    }

    #[Test]
    public function it_keeps_the_existing_code_when_not_provided(): void
    {
        $room = Room::factory()->create();

        $result = $this->action->execute(
            $room,
            new UpdateRoomData(name: 'Sala Renomeada')
        );

        $this->assertEquals($room->code, $result->code);
    }

    #[Test]
    public function it_deactivates_the_room_when_requested(): void
    {
        $room = Room::factory()->create(['active' => true]);

        $result = $this->action->execute(
            $room,
            new UpdateRoomData(active: false)
        );

        $this->assertFalse($result->active);
    }

    #[Test]
    public function it_stores_an_empty_location_when_an_empty_string_is_provided(): void
    {
        $room = Room::factory()->create(['location' => 'Piso 1']);

        $result = $this->action->execute(
            $room,
            new UpdateRoomData(location: '')
        );

        $this->assertSame('', $result->location);
    }
}
