<?php

namespace Tests\Feature;

use App\Enums\MaintenancePlanIntervalTypeEnum;
use App\Enums\PartUnitOfMeasureEnum;
use App\Enums\StockMovementTypeEnum;
use App\Models\Equipment;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\StockMovement;
use App\Models\TaxRate;
use Tests\Base\FeatureTestCase;

class StockManagementFeatureTest extends FeatureTestCase
{
    public function test_regular_user_is_forbidden_from_stock_endpoints(): void
    {
        $user = $this->createRegularUser();

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->getJson('/api/stock/parts')
            ->assertStatus(403);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->getJson('/api/stock/movements')
            ->assertStatus(403);
    }

    public function test_regular_user_is_forbidden_from_admin_stock_management(): void
    {
        $user = $this->createRegularUser();

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/api/admin/parts', [])
            ->assertStatus(403);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/api/admin/tax-rates', [])
            ->assertStatus(403);
    }

    public function test_technician_can_view_parts_but_not_manage_them(): void
    {
        $technician = $this->createTechnician();
        Part::factory()->create();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->actingAs($technician)
            ->getJson('/api/stock/parts')
            ->assertStatus(200)
            ->assertJsonStructure([
                'parts',
                'pagination' => ['current_page', 'last_page', 'total'],
            ]);

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->actingAs($technician)
            ->postJson('/api/admin/parts', [
                'sku' => 'TST-001',
                'name' => 'Peça teste',
                'unit_of_measure' => PartUnitOfMeasureEnum::Unit->value,
                'cost_price' => 10,
                'current_stock' => 0,
                'min_stock' => 1,
            ])
            ->assertStatus(403);
    }

    public function test_admin_can_create_part_with_initial_stock_movement(): void
    {
        $admin = $this->createAdmin();
        $category = PartCategory::factory()->create();
        $taxRate = TaxRate::factory()->normal()->create();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/parts', [
                'sku' => 'PC-CAT-001',
                'name' => 'Filtro de ar',
                'part_category_id' => $category->id,
                'unit_of_measure' => PartUnitOfMeasureEnum::Unit->value,
                'cost_price' => 25.50,
                'tax_rate_id' => $taxRate->id,
                'current_stock' => 10,
                'min_stock' => 5,
                'max_stock' => 50,
                'location' => 'Armazém A · Prateleira 1',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('part.sku', 'PC-CAT-001')
            ->assertJsonPath('part.current_stock', 0);

        $this->assertDatabaseHas('parts', [
            'sku' => 'PC-CAT-001',
            'current_stock' => 10,
        ]);

        $this->assertDatabaseHas('stock_movements', [
            'movement_type' => StockMovementTypeEnum::In->value,
            'quantity' => 10,
            'stock_after' => 10,
        ]);
    }

    public function test_stock_movement_out_updates_part_stock(): void
    {
        $admin = $this->createAdmin();
        $part = Part::factory()->create(['current_stock' => 20, 'cost_price' => 10]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/stock/movements', [
                'part_id' => $part->id,
                'movement_type' => StockMovementTypeEnum::Out->value,
                'quantity' => 6,
                'reason' => 'Intervenção técnica',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('movement.stock_after', 14);

        $this->assertDatabaseHas('parts', [
            'id' => $part->id,
            'current_stock' => 14,
        ]);

        $this->assertDatabaseHas('stock_movements', [
            'part_id' => $part->id,
            'movement_type' => StockMovementTypeEnum::Out->value,
            'quantity' => 6,
            'stock_after' => 14,
            'reason' => 'Intervenção técnica',
        ]);
    }

    public function test_stock_movement_cannot_drive_stock_negative(): void
    {
        $admin = $this->createAdmin();
        $part = Part::factory()->create(['current_stock' => 5]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/stock/movements', [
                'part_id' => $part->id,
                'movement_type' => StockMovementTypeEnum::Out->value,
                'quantity' => 10,
            ]);

        $response->assertStatus(422);

        $this->assertDatabaseHas('parts', [
            'id' => $part->id,
            'current_stock' => 5,
        ]);

        $this->assertDatabaseMissing('stock_movements', [
            'part_id' => $part->id,
            'quantity' => 10,
        ]);
    }

    public function test_admin_can_create_and_update_supplier(): void
    {
        $admin = $this->createAdmin();

        $create = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/suppliers', [
                'name' => 'Fornecedor A',
                'nif' => '500000001',
                'contact' => '+351 210 000 001',
                'email' => 'fornecedor@example.com',
                'avg_lead_time_days' => 7,
            ]);

        $create->assertStatus(201)
            ->assertJsonPath('supplier.name', 'Fornecedor A');

        $supplierId = $create->json('supplier.id');

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->patchJson("/api/admin/suppliers/{$supplierId}", [
                'name' => 'Fornecedor A Atualizado',
                'nif' => '500000001',
                'avg_lead_time_days' => 10,
            ])
            ->assertStatus(200)
            ->assertJsonPath('supplier.avg_lead_time_days', 10);

        $this->assertDatabaseHas('suppliers', [
            'id' => $supplierId,
            'name' => 'Fornecedor A Atualizado',
        ]);
    }

    public function test_admin_can_create_tax_rate(): void
    {
        $admin = $this->createAdmin();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/tax-rates', [
                'name' => 'Taxa Intermédia',
                'percent' => 13,
            ])
            ->assertStatus(201)
            ->assertJsonPath('tax_rate.percent', '13.00');

        $this->assertDatabaseHas('tax_rates', [
            'name' => 'Taxa Intermédia',
            'percent' => 13,
        ]);
    }

    public function test_admin_can_create_maintenance_plan_with_parts(): void
    {
        $admin = $this->createAdmin();
        $equipment = Equipment::factory()->create();
        $partOne = Part::factory()->create();
        $partTwo = Part::factory()->create();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/maintenance-plans', [
                'equipment_id' => $equipment->id,
                'name' => 'Revisão anual',
                'interval_type' => MaintenancePlanIntervalTypeEnum::Days->value,
                'interval_value' => 365,
                'description' => 'Inspeção anual preventiva',
                'active' => true,
                'parts' => [
                    ['part_id' => $partOne->id, 'expected_quantity' => 2],
                    ['part_id' => $partTwo->id, 'expected_quantity' => 1],
                ],
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('plan.name', 'Revisão anual');

        $this->assertDatabaseHas('maintenance_plan_part', [
            'part_id' => $partOne->id,
            'expected_quantity' => 2,
        ]);

        $this->assertDatabaseHas('maintenance_plan_part', [
            'part_id' => $partTwo->id,
            'expected_quantity' => 1,
        ]);
    }

    public function test_maintenance_plan_rejects_part_without_part_id(): void
    {
        $admin = $this->createAdmin();
        $equipment = Equipment::factory()->create();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/api/admin/maintenance-plans', [
                'equipment_id' => $equipment->id,
                'name' => 'Plano inválido',
                'interval_type' => MaintenancePlanIntervalTypeEnum::Days->value,
                'interval_value' => 30,
                'parts' => [
                    ['expected_quantity' => 1],
                ],
            ])
            ->assertStatus(422);
    }

    public function test_admin_can_access_dashboard_summary(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->getJson('/api/stock/dashboard/summary');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'total_stock_value',
                'total_parts',
                'low_stock_count',
                'parts_in_alert',
            ]);
    }

    public function test_admin_can_export_low_stock_csv(): void
    {
        $admin = $this->createAdmin();
        Part::factory()->lowStock()->create();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->get('/api/stock/reports/low-stock.csv')
            ->assertStatus(200)
            ->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_stock_movement_filters_by_part_and_type(): void
    {
        $admin = $this->createAdmin();
        $part = Part::factory()->create(['current_stock' => 10]);
        StockMovement::factory()->create([
            'part_id' => $part->id,
            'movement_type' => StockMovementTypeEnum::In->value,
            'quantity' => 10,
            'stock_after' => 10,
        ]);
        StockMovement::factory()->create([
            'part_id' => $part->id,
            'movement_type' => StockMovementTypeEnum::Out->value,
            'quantity' => -3,
            'stock_after' => 7,
        ]);

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->getJson("/api/stock/movements?part_id={$part->id}&movement_type=out")
            ->assertStatus(200)
            ->assertJsonPath('pagination.total', 1);
    }
}
