<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class RoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'building' => $this->building,
            'floor' => $this->floor,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'description' => $this->description,
            'notes' => $this->notes,
            'active' => $this->active,
            'equipments_count' => $this->whenCounted('equipments'),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
