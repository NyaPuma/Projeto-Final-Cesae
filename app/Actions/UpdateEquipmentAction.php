<?php

namespace App\Actions;

use App\DTOs\UpdateEquipmentData;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;

final readonly class UpdateEquipmentAction
{
    public function execute(Equipment $equipment, UpdateEquipmentData $data): Equipment
    {
        return DB::transaction(function () use ($equipment, $data) {
            $equipment->update([
                'name' => $data->name ? trim($data->name) : $equipment->name,
                'serial' => $data->serial !== null ? strtoupper(trim($data->serial)) : $equipment->serial,
                'room_id' => $data->roomId ?? $equipment->room_id,
                'category_id' => $data->categoryId ?? $equipment->category_id,
                'active' => $data->active ?? $equipment->active,
            ]);

            // Exemplo de disparo de evento no futuro:
            // EquipmentUpdated::dispatch($equipment);

            return $equipment->load(['room', 'category']);
        });
    }
}
