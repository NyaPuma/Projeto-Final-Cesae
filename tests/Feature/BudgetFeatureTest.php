<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BudgetFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    public function test_technician_can_request_budget_authorization(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget test ticket',
            'description' => 'Needs external parts',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
            'opened_at' => now()->subDay(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/request-budget", [
                'budget_amount' => 500.00,
                'budget_justification' => 'Need to replace the main motor bearing - special order part',
            ]);

        $response->assertOk()
            ->assertJsonStructure(['ticket' => [
                'id', 'status_id', 'budget_requested', 'budget_status', 'budget_amount', 'budget_requested_at',
            ]]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_PENDING_BUDGET));
        $this->assertTrue($ticket->budget_requested);
        $this->assertEquals(Ticket::BUDGET_PENDING, $ticket->budget_status);
        $this->assertEquals(500.00, (float) $ticket->budget_amount);
        $this->assertNotNull($ticket->budget_requested_at);
    }

    public function test_non_technician_cannot_request_budget(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget test ticket',
            'description' => 'Needs parts',
            'priority' => Ticket::PRIORITY_LOW,
            'status_id' => $inProgressId,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/request-budget", [
                'budget_amount' => 100.00,
                'budget_justification' => 'Test',
            ]);

        $response->assertStatus(403);
    }

    public function test_budget_request_validates_required_fields(): void
    {
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $user = $this->createUserWithToken(User::ROLE_USER);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget validation ticket',
            'description' => 'Testing validation',
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
            'opened_at' => now(),
        ]);

        // Missing both required fields
        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/request-budget", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['budget_amount', 'budget_justification']);
    }

    public function test_admin_can_approve_budget(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $pendingId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget approval ticket',
            'description' => 'Testing budget approval',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 750.00,
            'budget_requested_at' => now()->subDay(),
            'opened_at' => now()->subDays(2),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/tickets/{$ticket->id}/approve-budget", [
                'decision' => 'approve',
            ]);

        $response->assertOk();
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_APPROVED, $ticket->budget_status);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_IN_PROGRESS));
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
        $this->assertNotNull($ticket->budget_decided_at);
    }

    public function test_admin_can_reject_budget(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $pendingId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget rejection ticket',
            'description' => 'Testing budget rejection',
            'priority' => Ticket::PRIORITY_LOW,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 999.99,
            'budget_requested_at' => now()->subDay(),
            'opened_at' => now()->subDays(2),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->patchJson("/admin/tickets/{$ticket->id}/approve-budget", [
                'decision' => 'reject',
                'feedback' => 'Budget too high for this type of repair',
            ]);

        $response->assertOk();
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_REJECTED, $ticket->budget_status);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_REJECTED));
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
    }

    public function test_non_admin_cannot_approve_budget(): void
    {
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $user = $this->createUserWithToken(User::ROLE_USER);
        $pendingId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget unauthorized ticket',
            'description' => 'Testing unauthorized budget decision',
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => $pendingId,
            'budget_requested' => true,
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 200.00,
            'budget_requested_at' => now(),
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->patchJson("/admin/tickets/{$ticket->id}/approve-budget", [
                'decision' => 'approve',
            ]);

        $response->assertStatus(403);
    }
}
