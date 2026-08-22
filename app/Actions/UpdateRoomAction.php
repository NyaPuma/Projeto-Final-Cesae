<?php

namespace App\Actions;

use App\DTOs\UpdateRoomData;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

final readonly class UpdateRoomAction
{
    public function execute(Room $room, UpdateRoomData $data): Room
    {
        return DB::transaction(function () use ($room, $data) {
            $room->update([
                'name' => $data->name ? trim($data->name) : $room->name,
                'code' => $data->code ? strtoupper(trim($data->code)) : $room->code,
                'location' => $data->location !== null ? trim($data->location) : $room->location,
                'active' => $data->active ?? $room->active,
                'building' => $data->building ?? $room->building,
                'floor' => $data->floor ?? $room->floor,
                'capacity' => $data->capacity ?? $room->capacity,
                'description' => $data->description ?? $room->description,
                'notes' => $data->notes ?? $room->notes,
            ]);

            return $room;
        });
    }
}
