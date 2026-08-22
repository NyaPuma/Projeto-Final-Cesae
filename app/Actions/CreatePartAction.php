<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\StorePartData;
use App\Models\Part;
use App\Models\StockMovement;
use App\Enums\StockMovementTypeEnum;
use App\Services\StockMovementService;
use Illuminate\Support\Facades\DB;

final readonly class CreatePartAction
{
    public function __construct(
        private StockMovementService $stockMovementService,
    ) {}

    public function execute(StorePartData $data): Part
    {
        return DB::transaction(function () use ($data) {
            $part = Part::create([
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
                'current_stock' => 0,
                'min_stock' => $data->minStock,
                'max_stock' => $data->maxStock,
                'location' => $data->location,
                'photo' => $data->photo,
                'active' => $data->active,
                'technical_notes' => $data->technicalNotes,
            ]);

            if ($data->currentStock > 0) {
                $this->stockMovementService->record(
                    part: $part,
                    movementType: StockMovementTypeEnum::In,
                    quantity: $data->currentStock,
                    reason: __('stock.Stock inicial de catalogação'),
                );
            }

            return $part->load(['category', 'taxRate', 'suppliers']);
        });
    }
}
