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
                'asset_tag' => $data->assetTag ?? $equipment->asset_tag,
                'brand' => $data->brand ?? $equipment->brand,
                'model' => $data->model ?? $equipment->model,
                'manufacturer' => $data->manufacturer ?? $equipment->manufacturer,
                'purchase_date' => $data->purchaseDate ?? $equipment->purchase_date,
                'warranty_until' => $data->warrantyUntil ?? $equipment->warranty_until,
                'status' => $data->status ?? $equipment->status,
                'notes' => $data->notes ?? $equipment->notes,
            ]);

            // Exemplo de disparo de evento no futuro:
            // EquipmentUpdated::dispatch($equipment);

            return $equipment->load(['room', 'category']);
        });
    }
}
