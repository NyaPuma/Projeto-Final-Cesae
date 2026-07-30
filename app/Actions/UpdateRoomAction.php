<?php

namespace App\Actions;

use App\DTOs\UpdateRoomData;
use App\Models\Room;

final readonly class UpdateRoomAction
{
    public function execute(Room $room, UpdateRoomData $data): Room
    {
        $room->update([
            'name' => $data->name ?? $room->name,
            'code' => $data->code ?? $room->code,
            'location' => $data->location ?? $room->location,
            'active' => $data->active ?? $room->active,
        ]);

        return $room;
    }
}
