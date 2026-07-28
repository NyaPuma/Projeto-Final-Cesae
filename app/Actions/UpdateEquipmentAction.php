<?php

namespace App\Actions;

use App\DTOs\UpdateEquipmentData;
use App\Models\Equipment;

final readonly class UpdateEquipmentAction
{
    public function execute(Equipment $equipment, UpdateEquipmentData $data): Equipment
    {
        $equipment->update([
            'name' => $data->name,
            'serial' => $data->serial,
            'room_id' => $data->roomId,
            'category_id' => $data->categoryId,
            'active' => $data->active ?? $equipment->active,
        ]);

        return $equipment;
    }
}
