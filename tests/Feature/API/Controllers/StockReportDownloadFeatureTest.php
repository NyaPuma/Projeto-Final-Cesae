<?php

declare(strict_types=1);

namespace Tests\Feature\API\Controllers;

use App\Models\Part;
use Tests\Base\FeatureTestCase;

final class StockReportDownloadFeatureTest extends FeatureTestCase
{
    public function test_admin_can_download_low_stock_csv(): void
    {
        $admin = $this->createAdmin();
        $part = Part::factory()->lowStock()->create([
            'sku' => 'LOW-001',
            'name' => 'Low stock test part',
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->get('/api/stock/reports/low-stock.csv');

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $content = $response->streamedContent();
        $this->assertStringStartsWith("\xEF\xBB\xBF", $content);
        $this->assertStringContainsString($part->sku, $content);
    }

    public function test_admin_can_download_inventory_csv(): void
    {
        $admin = $this->createAdmin();
        $part = Part::factory()->create([
            'sku' => 'INV-001',
            'name' => 'Inventory test part',
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->get('/api/stock/reports/inventory.csv');

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $content = $response->streamedContent();
        $this->assertStringContainsString($part->sku, $content);
    }
}
