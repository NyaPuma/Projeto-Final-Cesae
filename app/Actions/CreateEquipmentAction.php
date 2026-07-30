<?php

namespace App\Actions;

use App\DTOs\StoreEquipmentData;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;

final readonly class CreateEquipmentAction
{
    public function execute(StoreEquipmentData $data): Equipment
    {
        return DB::transaction(function () use ($data) {
            $equipment = Equipment::create([
                'name' => trim($data->name),
                'serial' => $data->serial ? strtoupper(trim($data->serial)) : null,
                'room_id' => $data->roomId,
                'category_id' => $data->categoryId,
                'active' => $data->active ?? true,
            ]);

            // Exemplo de disparo de evento no futuro:
            // EquipmentCreated::dispatch($equipment);

            return $equipment->load(['room', 'category']);
        });
    }
}
