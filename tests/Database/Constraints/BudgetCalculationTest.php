<?php

namespace Tests\Database\Constraints;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\BudgetCalculatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetCalculationTest extends TestCase
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
    // SECTION 14: BUDGET CALCULATION ACCESSORS
    // ==========================================

    public function test_budget_total_accessor(): void
    {
        $user = $this->createCommonUser();
        $this->asUserWithToken($user);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Calc Test',
            'description' => 'Accessor test',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $details = [
            ['description' => 'Part', 'type' => 'material', 'quantity' => 2, 'unit_price' => 10.00],
            ['description' => 'Work', 'type' => 'labor', 'hours' => 3, 'hourly_rate' => 20.00],
        ];

        $ticket = Ticket::find($ticketId);
        $ticket->update(['budget_details' => $details]);
        $ticket->refresh();

        $calculator = app(BudgetCalculatorService::class);
        $this->assertEquals(20.00, $calculator->calculateTotalMaterialCost($ticket));
        $this->assertEquals(60.00, $calculator->calculateTotalLaborCost($ticket));
        $this->assertEquals(80.00, $calculator->calculateBudgetTotal($ticket));
    }

    // ==========================================
    // SECTION 15: SLA CALCULATION
    // ==========================================

    public function test_budget_pause_minutes_calculation(): void
    {
        $admin = $this->createAdmin();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'SLA Test',
            'description' => 'SLA pause',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'budget_requested_at' => now()->subHours(2),
            'budget_decided_at' => now(),
        ]);
        $ticket->refresh();

        $this->assertEquals(120, $ticket->budget_pause_minutes);
    }
}
