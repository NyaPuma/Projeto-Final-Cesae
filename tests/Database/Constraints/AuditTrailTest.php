<?php

namespace Tests\Database\Constraints;

use App\Enums\UserRoleEnum;
use App\Models\Audit;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditTrailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }

    protected function createCommonUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
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
    // SECTION 6: AUDIT TRAIL INTEGRITY
    // ==========================================

    public function test_ticket_creation_generates_audit_record(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Audit Trail Test',
            'description' => 'Should create audit',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $audit = Audit::where('auditable_type', Ticket::class)
            ->where('auditable_id', $ticketId)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit, 'Audit record should be created for ticket creation');
        $this->assertNotNull($audit->new_values);
    }

    public function test_ticket_update_generates_audit_record(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Audit Update Test',
            'description' => 'Will update',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update(['title' => 'Updated Title for Audit']);

        $audit = Audit::where('auditable_type', Ticket::class)
            ->where('auditable_id', $ticketId)
            ->where('event', 'updated')
            ->latest('id')
            ->first();

        $this->assertNotNull($audit, 'Audit record should be created for ticket update');
        $this->assertArrayHasKey('title', $audit->new_values);
    }
}
