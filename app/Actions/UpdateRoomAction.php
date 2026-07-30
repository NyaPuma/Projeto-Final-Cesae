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
            ]);

            // Exemplo de disparo de evento no futuro:
            // RoomUpdated::dispatch($room);

            return $room;
        });
    }
}
