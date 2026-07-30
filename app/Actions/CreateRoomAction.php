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
                'code' => strtoupper(trim($data->code)),
                'location' => $data->location ? trim($data->location) : null,
                'active' => $data->active ?? true,
            ]);

            // Exemplo de disparo de evento no futuro:
            // RoomCreated::dispatch($room);

            return $room;
        });
    }
}
