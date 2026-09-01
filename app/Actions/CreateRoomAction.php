<?php

namespace App\Actions;

use App\DTOs\StoreRoomData;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

final readonly class CreateRoomAction
{
    public function execute(StoreRoomData $data): Room
    {
        return DB::transaction(function () use ($data) {
            $room = Room::create([
                'name' => trim($data->name),
                'code' => $data->code !== null && trim($data->code) !== ''
                    ? strtoupper(trim($data->code))
                    : null,
                'location' => $data->location ? trim($data->location) : null,
                'active' => $data->active,
                'building' => $data->building,
                'floor' => $data->floor,
                'capacity' => $data->capacity,
                'description' => $data->description,
                'notes' => $data->notes,
            ]);

            return $room;
        });
    }
}
