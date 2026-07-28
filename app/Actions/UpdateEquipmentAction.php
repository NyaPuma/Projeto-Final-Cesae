<?php

namespace App\Actions;

use App\DTOs\UpdateEquipmentData;
use App\Models\Equipment;

final readonly class UpdateEquipmentAction
{
    public function execute(Equipment $equipment, UpdateEquipmentData $data): Equipment
    {
        $equipment->update([
            'name' => $data->name ?? $equipment->name,
            'serial' => $data->serial ?? $equipment->serial,
            'room_id' => $data->roomId ?? $equipment->room_id,
            'category_id' => $data->categoryId ?? $equipment->category_id,
            'active' => $data->active ?? $equipment->active,
        ]);

        return $equipment;
    }
}
