<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\MaintenancePlanIntervalTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class MaintenancePlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $intervalType = MaintenancePlanIntervalTypeEnum::tryFrom($this->interval_type);

        return [
            'id' => $this->id,
            'equipment_id' => $this->equipment_id,
            'equipment' => $this->whenLoaded('equipment', fn () => new EquipmentResource($this->equipment)),
            'name' => $this->name,
            'interval_type' => $this->interval_type,
            'interval_type_label' => $intervalType?->label(),
            'interval_value' => $this->interval_value,
            'description' => $this->description,
            'active' => $this->active,
            'parts' => $this->whenLoaded('parts', fn () => $this->parts->map(fn ($part) => [
                'id' => $part->id,
                'sku' => $part->sku,
                'name' => $part->name,
                'expected_quantity' => $part->pivot->expected_quantity,
            ])),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
