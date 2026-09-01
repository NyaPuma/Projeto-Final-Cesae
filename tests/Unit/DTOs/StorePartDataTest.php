<?php

namespace Tests\Unit\DTOs;

use App\DTOs\StorePartData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StorePartDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new StorePartData(
            sku: 'SKU-1',
            name: 'Parafuso',
            description: null,
            brand: null,
            manufacturerRef: null,
            partCategoryId: null,
            unitOfMeasure: 'unit',
            costPrice: 1.5,
            taxRateId: null,
            salePrice: null,
            currentStock: 0,
            minStock: 0,
            maxStock: null,
            location: null,
            photo: null,
            active: true,
            technicalNotes: null,
        );

        $this->assertEquals('SKU-1', $dto->sku);
        $this->assertEquals('Parafuso', $dto->name);
        $this->assertEquals('unit', $dto->unitOfMeasure);
        $this->assertEquals(1.5, $dto->costPrice);
        $this->assertTrue($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_sanitizes(): void
    {
        $dto = StorePartData::fromRequest([
            'sku' => '  sku-2  ',
            'name' => '  Rolamento  ',
            'description' => '  Para motor  ',
            'brand' => '  SKF  ',
            'manufacturer_ref' => '  REF-01  ',
            'part_category_id' => '3',
            'unit_of_measure' => 'unit',
            'cost_price' => '10.50',
            'tax_rate_id' => '2',
            'sale_price' => '15.75',
            'current_stock' => '5',
            'min_stock' => '1',
            'max_stock' => '20',
            'location' => 'Piso 1',
            'photo' => 'parts/rolamento.png',
            'active' => '1',
            'technical_notes' => 'Verificar',
        ]);

        $this->assertEquals('SKU-2', $dto->sku);
        $this->assertEquals('Rolamento', $dto->name);
        $this->assertEquals('Para motor', $dto->description);
        $this->assertEquals('SKF', $dto->brand);
        $this->assertEquals('REF-01', $dto->manufacturerRef);
        $this->assertEquals(3, $dto->partCategoryId);
        $this->assertEquals('unit', $dto->unitOfMeasure);
        $this->assertEquals(10.5, $dto->costPrice);
        $this->assertEquals(2, $dto->taxRateId);
        $this->assertEquals(15.75, $dto->salePrice);
        $this->assertEquals(5, $dto->currentStock);
        $this->assertEquals(1, $dto->minStock);
        $this->assertEquals(20, $dto->maxStock);
        $this->assertEquals('Piso 1', $dto->location);
        $this->assertEquals('parts/rolamento.png', $dto->photo);
        $this->assertTrue($dto->active);
        $this->assertEquals('Verificar', $dto->technicalNotes);
    }

    #[Test]
    public function it_applies_defaults_for_missing_fields(): void
    {
        $dto = StorePartData::fromRequest([
            'sku' => 'SKU-3',
            'name' => 'Anilha',
            'cost_price' => '0.25',
        ]);

        $this->assertEquals(0, $dto->currentStock);
        $this->assertEquals(0, $dto->minStock);
        $this->assertEquals('unit', $dto->unitOfMeasure);
        $this->assertTrue($dto->active);
        $this->assertNull($dto->maxStock);
        $this->assertNull($dto->salePrice);
        $this->assertNull($dto->location);
    }

    #[Test]
    public function it_treats_blank_sale_price_as_null(): void
    {
        $dto = StorePartData::fromRequest([
            'sku' => 'SKU-4',
            'name' => 'Junta',
            'cost_price' => '1.00',
            'sale_price' => '',
        ]);

        $this->assertNull($dto->salePrice);
    }

    #[Test]
    public function it_rejects_negative_initial_stock(): void
    {
        $this->expectException(InvalidArgumentException::class);

        StorePartData::fromRequest([
            'sku' => 'SKU-5',
            'name' => 'Parafuso',
            'cost_price' => '1.00',
            'current_stock' => '-1',
        ]);
    }
}
