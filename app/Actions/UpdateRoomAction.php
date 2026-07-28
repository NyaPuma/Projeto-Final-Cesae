<?php

namespace App\Actions;

use App\DTOs\UpdateRoomData;
use App\Models\Room;

final readonly class UpdateRoomAction
{
    public function execute(Room $room, UpdateRoomData $data): Room
    {
        $room->update([
            'name' => $data->name,
            'code' => $data->code,
            'location' => $data->location,
            'active' => $data->active ?? $room->active,
        ]);

        return $room;
    }
}
