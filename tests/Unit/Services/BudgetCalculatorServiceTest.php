<?php

namespace Tests\Unit\Services;

use App\Models\Ticket;
use App\Services\BudgetCalculatorService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetCalculatorServiceTest extends TestCase
{
    private BudgetCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new BudgetCalculatorService();
    }

    #[Test]
    public function it_calculates_material_total_from_quantity_and_unit_price(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['type' => 'material', 'quantity' => 2, 'unit_price' => 50],
            ['type' => 'material', 'quantity' => 1, 'unit_price' => 25],
            ['type' => 'labor', 'hours' => 3, 'hourly_rate' => 20],
        ]]);

        $this->assertEquals(125.0, $this->service->calculateTotalMaterialCost($ticket));
    }

    #[Test]
    public function it_calculates_labor_total_from_hours_and_hourly_rate(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['type' => 'labor', 'hours' => 3, 'hourly_rate' => 20],
            ['type' => 'labor', 'hours' => 1.5, 'hourly_rate' => 40],
            ['type' => 'material', 'quantity' => 5, 'unit_price' => 10],
        ]]);

        $this->assertEquals(120.0, $this->service->calculateTotalLaborCost($ticket));
    }

    #[Test]
    public function it_calculates_budget_total_as_sum_of_material_and_labor(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['type' => 'material', 'quantity' => 2, 'unit_price' => 100],
            ['type' => 'labor', 'hours' => 4, 'hourly_rate' => 50],
        ]]);

        $this->assertEquals(400.0, $this->service->calculateBudgetTotal($ticket));
    }

    #[Test]
    public function it_returns_zero_totals_for_empty_details(): void
    {
        $ticket = new Ticket(['budget_details' => []]);

        $this->assertEquals(0.0, $this->service->calculateTotalMaterialCost($ticket));
        $this->assertEquals(0.0, $this->service->calculateTotalLaborCost($ticket));
        $this->assertEquals(0.0, $this->service->calculateBudgetTotal($ticket));
    }

    #[Test]
    public function it_defaults_missing_item_type_to_material(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['quantity' => 3, 'unit_price' => 10],
        ]]);

        $this->assertEquals(30.0, $this->service->calculateTotalMaterialCost($ticket));
    }

    #[Test]
    public function it_treats_missing_quantity_or_rate_fields_as_zero(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['type' => 'material', 'quantity' => 2],
            ['type' => 'labor', 'hours' => 3],
        ]]);

        $this->assertEquals(0.0, $this->service->calculateTotalMaterialCost($ticket));
        $this->assertEquals(0.0, $this->service->calculateTotalLaborCost($ticket));
    }

    #[Test]
    public function it_builds_a_detailed_breakdown_with_subtotals(): void
    {
        $ticket = new Ticket(['budget_details' => [
            ['type' => 'material', 'description' => 'Cabo', 'quantity' => 2, 'unit_price' => 50],
            ['type' => 'labor', 'description' => 'Instalação', 'hours' => 3, 'hourly_rate' => 20],
        ]]);

        $breakdown = $this->service->getBreakdown($ticket);

        $this->assertCount(1, $breakdown['materials']);
        $this->assertCount(1, $breakdown['labor']);
        $this->assertEquals(100.0, $breakdown['material_total']);
        $this->assertEquals(60.0, $breakdown['labor_total']);
        $this->assertEquals(160.0, $breakdown['grand_total']);
        $this->assertEquals(100.0, $breakdown['materials'][0]['subtotal']);
        $this->assertEquals(60.0, $breakdown['labor'][0]['subtotal']);
        $this->assertEquals('Cabo', $breakdown['materials'][0]['description']);
    }

    #[Test]
    public function it_builds_an_empty_breakdown_for_no_details(): void
    {
        $ticket = new Ticket(['budget_details' => null]);

        $breakdown = $this->service->getBreakdown($ticket);

        $this->assertEmpty($breakdown['materials']);
        $this->assertEmpty($breakdown['labor']);
        $this->assertEquals(0.0, $breakdown['material_total']);
        $this->assertEquals(0.0, $breakdown['labor_total']);
        $this->assertEquals(0.0, $breakdown['grand_total']);
    }
}
