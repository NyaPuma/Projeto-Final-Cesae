<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\TaxRateActions;
use App\Models\TaxRate;
use Tests\Base\DatabaseTestCase;

final class TaxRateActionsTest extends DatabaseTestCase
{
    private TaxRateActions $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new TaxRateActions();
    }

    public function test_it_creates_tax_rate_and_handles_default_flag(): void
    {
        // Arrange
        $existingDefault = TaxRate::factory()->create(['is_default' => true]);

        // Act
        $newRate = $this->action->create('IVA Normal', 23.00, true, true);

        // Assert
        $this->assertInstanceOf(TaxRate::class, $newRate);
        $this->assertSame('IVA Normal', $newRate->name);
        $this->assertTrue($newRate->is_default);

        $this->assertFalse($existingDefault->fresh()->is_default);
        $this->assertDatabaseHas('tax_rates', [
            'id' => $newRate->id,
            'name' => 'IVA Normal',
            'is_default' => true,
        ]);
    }

    public function test_it_updates_tax_rate(): void
    {
        // Arrange
        $rate = TaxRate::factory()->create(['name' => 'Taxa 1', 'percent' => 6.00]);

        // Act
        $updated = $this->action->update($rate, 'Taxa Reduzida', 6.00, false, true);

        // Assert
        $this->assertSame('Taxa Reduzida', $updated->name);
        $this->assertDatabaseHas('tax_rates', [
            'id' => $rate->id,
            'name' => 'Taxa Reduzida',
        ]);
    }
}
