<?php

namespace Tests\Database\Constraints;

use App\Models\TicketAttachment;
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttachmentPersistenceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createAdmin(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $token = 'admin-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createTechnician(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        $token = 'tech-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createCommonUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $token = 'user-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function asUserWithToken(User $user): static
    {
        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    // ==========================================
    // SECTION 21: ATTACHMENT INTEGRITY
    // ==========================================

    public function test_attachment_belongs_to_ticket_and_user(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Attachment Test Ticket',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');
        $user = $this->createCommonUser();

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticketId,
            'user_id' => $user->id,
            'file_name' => 'test.jpg',
            'path' => 'ticket_photos/test.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
        ]);

        $this->assertNotNull($attachment->user);
        $this->assertEquals($user->id, $attachment->user_id);
        $this->assertNotNull($attachment->ticket);
        $this->assertEquals($ticketId, $attachment->ticket_id);
    }

    // ==========================================
    // SECTION 22: WORKFLOW HISTORY INTEGRITY
    // ==========================================

    public function test_workflow_history_model_crud(): void
    {
        $user = $this->createTechnician();
        $openStatus = TicketStatus::where('name', 'aberta')->first();
        $inProgressStatus = TicketStatus::where('name', 'em curso')->first();

        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Workflow History Test',
            'description' => 'Test',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $technician = $this->createTechnician();
        $wh = TicketWorkflowHistory::create([
            'ticket_id' => $ticketId,
            'origin_status_id' => $openStatus->id,
            'destination_status_id' => $inProgressStatus->id,
            'technician_id' => $technician->id,
            'comment' => 'Starting repair',
        ]);

        $this->assertNotNull($wh->ticket);
        $this->assertNotNull($wh->originStatus);
        $this->assertNotNull($wh->destinationStatus);
        $this->assertNotNull($wh->technician);
    }
}
