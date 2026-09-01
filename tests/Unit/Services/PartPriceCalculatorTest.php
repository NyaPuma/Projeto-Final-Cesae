<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\Part;
use App\Models\TaxRate;
use App\Services\PartPriceCalculator;
use Tests\Base\DatabaseTestCase;

final class PartPriceCalculatorTest extends DatabaseTestCase
{
    private PartPriceCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new PartPriceCalculator();
    }

    public function test_it_calculates_price_with_vat_from_tax_rate(): void
    {
        // Arrange
        $taxRate = TaxRate::factory()->create(['percent' => 23.00]);
        $part = Part::factory()->create([
            'cost_price' => 100.00,
            'tax_rate_id' => $taxRate->id,
        ]);

        // Act
        $priceWithVat = $this->calculator->priceWithVat($part);
        $vatAmount = $this->calculator->vatAmount($part);

        // Assert
        $this->assertSame(123.00, $priceWithVat);
        $this->assertSame(23.00, $vatAmount);
    }

    public function test_it_calculates_sale_price_with_vat(): void
    {
        // Arrange
        $taxRate = TaxRate::factory()->create(['percent' => 13.00]);
        $part = Part::factory()->create([
            'sale_price' => 50.00,
            'tax_rate_id' => $taxRate->id,
        ]);

        // Act
        $salePriceWithVat = $this->calculator->salePriceWithVat($part);

        // Assert
        $this->assertSame(56.50, $salePriceWithVat);
    }

    public function test_it_handles_null_tax_rate_gracefully(): void
    {
        // Arrange
        $part = Part::factory()->create([
            'cost_price' => 75.00,
            'tax_rate_id' => null,
            'sale_price' => null,
        ]);

        // Act & Assert
        $this->assertSame(75.00, $this->calculator->priceWithVat($part));
        $this->assertSame(0.00, $this->calculator->vatAmount($part));
        $this->assertNull($this->calculator->salePriceWithVat($part));
    }
}
