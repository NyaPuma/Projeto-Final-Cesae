<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\GenerateAiRecommendationJob;
use App\Models\Equipment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\Base\FeatureTestCase;

final class PublicTicketFeatureTest extends FeatureTestCase
{
    public function test_guest_can_view_public_ticket_creation_form(): void
    {
        // Arrange
        $equipment = Equipment::factory()->create();

        // Act
        $response = $this->get("/ticket/new?machine_id={$equipment->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('ui.tickets.public.create');
        $response->assertSee($equipment->name);
    }

    public function test_guest_can_submit_public_ticket_with_photo(): void
    {
        // Arrange
        Queue::fake();
        Storage::fake('public');

        $admin = $this->createAdmin();
        $equipment = Equipment::factory()->create();
        $file = UploadedFile::fake()->image('avaria.png', 600, 400);

        // Act
        $response = $this->post('/ticket/store', [
            'equipment_id' => $equipment->id,
            'problem_type' => 'avaria',
            'description' => 'A máquina não liga ao carregar no interruptor principal.',
            'reporter_name' => 'João Silva',
            'reporter_contact' => '912345678',
            'photo' => $file,
        ]);

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('tickets', [
            'equipment_id' => $equipment->id,
            'reporter_name' => 'João Silva',
            'reporter_contact' => '912345678',
        ]);

        $this->assertDatabaseHas('ticket_attachments', [
            'original_name' => 'avaria.png',
        ]);

        Queue::assertPushed(GenerateAiRecommendationJob::class);
    }

    public function test_public_ticket_submission_fails_validation_without_required_fields(): void
    {
        // Act
        $response = $this->from('/ticket/new')->post('/ticket/store', []);

        // Assert
        $response->assertRedirect('/ticket/new');
        $response->assertSessionHasErrors(['equipment_id', 'description']);
    }
}
