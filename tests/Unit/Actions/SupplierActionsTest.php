<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateSupplierAction;
use App\Actions\UpdateSupplierAction;
use App\DTOs\StoreSupplierData;
use App\DTOs\UpdateSupplierData;
use App\Models\Supplier;
use Tests\Base\DatabaseTestCase;

final class SupplierActionsTest extends DatabaseTestCase
{
    private CreateSupplierAction $createAction;

    private UpdateSupplierAction $updateAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createAction = new CreateSupplierAction;
        $this->updateAction = new UpdateSupplierAction;
    }

    public function test_it_creates_supplier_from_dto(): void
    {
        // Arrange
        $dto = new StoreSupplierData(
            name: 'Electro Supplies Lda',
            nif: '501234567',
            contact: '+351 220 000 000',
            email: 'contacto@electrosupplies.pt',
            address: 'Rua Central, Porto',
            avgLeadTimeDays: 5,
        );

        // Act
        $supplier = $this->createAction->execute($dto);

        // Assert
        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertSame('Electro Supplies Lda', $supplier->name);
        $this->assertSame('501234567', $supplier->nif);
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'nif' => '501234567',
        ]);
    }

    public function test_it_updates_supplier_from_dto(): void
    {
        // Arrange
        $supplier = Supplier::factory()->create(['name' => 'Antigo']);
        $dto = new UpdateSupplierData(
            name: 'Nome Atualizado',
            nif: '509999999',
            contact: '+351 910 000 000',
            email: 'geral@atualizado.pt',
            address: 'Lisboa',
            avgLeadTimeDays: 3,
        );

        // Act
        $updated = $this->updateAction->execute($supplier, $dto);

        // Assert
        $this->assertSame('Nome Atualizado', $updated->name);
        $this->assertSame('509999999', $updated->nif);
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'Nome Atualizado',
            'nif' => '509999999',
        ]);
    }
}
