<?php

namespace App\Actions;

use App\DTOs\StoreEquipmentData;
use App\Models\Equipment;

final readonly class CreateEquipmentAction
{
    public function execute(StoreEquipmentData $data): Equipment
    {
        return Equipment::create([
            'name' => $data->name,
            'serial' => $data->serial,
            'room_id' => $data->roomId,
            'category_id' => $data->categoryId,
            'active' => $data->active ?? true,
        ]);
    }
}
