<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreatePartAction;
use App\Actions\UpdatePartAction;
use App\DTOs\StorePartData;
use App\DTOs\UpdatePartData;
use App\Enums\PartUnitOfMeasureEnum;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\TaxRate;
use App\Services\StockMovementService;
use Tests\Base\DatabaseTestCase;

final class PartActionsTest extends DatabaseTestCase
{
    private CreatePartAction $createAction;
    private UpdatePartAction $updateAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createAction = new CreatePartAction(new StockMovementService());
        $this->updateAction = new UpdatePartAction();
    }

    public function test_it_creates_part_and_initializes_stock_movement(): void
    {
        // Arrange
        $category = PartCategory::factory()->create();
        $taxRate = TaxRate::factory()->create();

        $dto = new StorePartData(
            sku: 'PART-SKU-999',
            name: 'Cabo de Rede Cat6',
            description: 'Cabo 5m',
            brand: 'BrandX',
            manufacturerRef: 'REF-999',
            partCategoryId: $category->id,
            unitOfMeasure: PartUnitOfMeasureEnum::Unit->value,
            costPrice: 5.50,
            taxRateId: $taxRate->id,
            salePrice: 10.00,
            currentStock: 15,
            minStock: 2,
            maxStock: 50,
            location: 'A1',
            photo: null,
            active: true,
            technicalNotes: 'Notas',
        );

        // Act
        $part = $this->createAction->execute($dto);

        // Assert
        $this->assertInstanceOf(Part::class, $part);
        $this->assertSame('PART-SKU-999', $part->sku);
        $this->assertSame(15, $part->fresh()->current_stock);
        $this->assertDatabaseHas('parts', [
            'id' => $part->id,
            'sku' => 'PART-SKU-999',
            'current_stock' => 15,
        ]);
        $this->assertDatabaseHas('stock_movements', [
            'part_id' => $part->id,
            'quantity' => 15,
        ]);
    }

    public function test_it_updates_part(): void
    {
        // Arrange
        $part = Part::factory()->create(['name' => 'Original Name']);
        $category = PartCategory::factory()->create();
        $taxRate = TaxRate::factory()->create();

        $dto = new UpdatePartData(
            sku: $part->sku,
            name: 'Updated Name',
            description: 'Desc',
            brand: 'Brand',
            manufacturerRef: 'Ref',
            partCategoryId: $category->id,
            unitOfMeasure: PartUnitOfMeasureEnum::Unit->value,
            costPrice: 20.00,
            taxRateId: $taxRate->id,
            salePrice: 35.00,
            minStock: 5,
            maxStock: 100,
            location: 'B2',
            photo: null,
            active: true,
            technicalNotes: 'Updated notes',
        );

        // Act
        $updated = $this->updateAction->execute($part, $dto);

        // Assert
        $this->assertSame('Updated Name', $updated->name);
        $this->assertDatabaseHas('parts', [
            'id' => $part->id,
            'name' => 'Updated Name',
            'cost_price' => 20.00,
        ]);
    }
}
