<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class SupplierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nif' => $this->nif,
            'contact' => $this->contact,
            'email' => $this->email,
            'address' => $this->address,
            'avg_lead_time_days' => $this->avg_lead_time_days,
            'parts' => $this->whenLoaded('parts', fn () => PartResource::collection($this->parts)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
