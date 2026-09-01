<?php

namespace Tests\Unit\DTOs;

use App\DTOs\UpdateSupplierData;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateSupplierDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new UpdateSupplierData(
            name: 'Fornecedor A',
            nif: '500000000',
            contact: null,
            email: null,
            address: null,
            avgLeadTimeDays: null,
        );

        $this->assertEquals('Fornecedor A', $dto->name);
        $this->assertEquals('500000000', $dto->nif);
        $this->assertNull($dto->contact);
        $this->assertNull($dto->email);
        $this->assertNull($dto->address);
        $this->assertNull($dto->avgLeadTimeDays);
    }

    #[Test]
    public function it_creates_dto_from_request_and_sanitizes(): void
    {
        $dto = UpdateSupplierData::fromRequest([
            'name' => '  Fornecedor B  ',
            'nif' => ' 501111111 ',
            'contact' => ' 912345678 ',
            'email' => 'forn@example.pt',
            'address' => ' Rua X, 1 ',
            'avg_lead_time_days' => '5',
        ]);

        $this->assertEquals('Fornecedor B', $dto->name);
        $this->assertEquals('501111111', $dto->nif);
        $this->assertEquals('912345678', $dto->contact);
        $this->assertEquals('forn@example.pt', $dto->email);
        $this->assertEquals('Rua X, 1', $dto->address);
        $this->assertEquals(5, $dto->avgLeadTimeDays);
    }

    #[Test]
    public function it_treats_missing_optional_fields_as_null(): void
    {
        $dto = UpdateSupplierData::fromRequest(['name' => 'Fornecedor C']);

        $this->assertNull($dto->nif);
        $this->assertNull($dto->contact);
        $this->assertNull($dto->email);
        $this->assertNull($dto->address);
        $this->assertNull($dto->avgLeadTimeDays);
    }
}
