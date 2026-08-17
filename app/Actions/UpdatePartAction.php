<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UpdatePartData;
use App\Models\Part;
use Illuminate\Support\Facades\DB;

final readonly class UpdatePartAction
{
    public function execute(Part $part, UpdatePartData $data): Part
    {
        return DB::transaction(function () use ($part, $data) {
            $part->update([
                'sku' => $data->sku,
                'name' => $data->name,
                'description' => $data->description,
                'brand' => $data->brand,
                'manufacturer_ref' => $data->manufacturerRef,
                'part_category_id' => $data->partCategoryId,
                'unit_of_measure' => $data->unitOfMeasure,
                'cost_price' => $data->costPrice,
                'tax_rate_id' => $data->taxRateId,
                'sale_price' => $data->salePrice,
                'min_stock' => $data->minStock,
                'max_stock' => $data->maxStock,
                'location' => $data->location,
                'photo' => $data->photo,
                'active' => $data->active,
                'technical_notes' => $data->technicalNotes,
            ]);

            return $part->load(['category', 'taxRate', 'suppliers']);
        });
    }
}
