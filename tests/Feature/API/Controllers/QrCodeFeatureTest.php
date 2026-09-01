<?php

declare(strict_types=1);

namespace Tests\Feature\API\Controllers;

use App\Jobs\ExportEquipmentQrPdfJob;
use App\Models\Equipment;
use Illuminate\Support\Facades\Queue;
use Tests\Base\FeatureTestCase;

final class QrCodeFeatureTest extends FeatureTestCase
{
    public function test_authenticated_user_can_view_equipment_qr_page(): void
    {
        // Arrange
        $user = $this->createAdmin();
        $equipment = Equipment::factory()->create();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->get("/ui/equipments/{$equipment->id}/qr");

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('ui.equipments.qr');
        $response->assertSee($equipment->name);
    }

    public function test_authenticated_user_can_download_equipment_qr_png(): void
    {
        // Arrange
        $user = $this->createAdmin();
        $equipment = Equipment::factory()->create();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->get("/ui/equipments/{$equipment->id}/qr/download");

        // Assert
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'image/png');
    }

    public function test_authenticated_user_can_dispatch_bulk_qr_pdf_export(): void
    {
        // Arrange
        Queue::fake();
        $user = $this->createAdmin();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->getJson('/ui/equipments/qr/export');

        // Assert
        $response->assertStatus(200);
        Queue::assertPushed(ExportEquipmentQrPdfJob::class);
    }
}
