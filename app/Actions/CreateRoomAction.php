<?php

namespace App\Actions;

use App\DTOs\StoreRoomData;
use App\Models\Room;

final readonly class CreateRoomAction
{
    public function execute(StoreRoomData $data): Room
    {
        return Room::create([
            'name' => $data->name,
            'code' => $data->code,
            'location' => $data->location,
            'active' => $data->active ?? true,
        ]);
    }
}
