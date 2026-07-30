<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BudgetFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
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
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget test ticket',
            'description' => 'Needs external parts',
            'priority' => TicketPriorityEnum::Medium->value,
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
                'id',
                'status_id',
                'budget_requested',
                'budget_status',
                'budget_amount',
                'budget_requested_at',
            ]]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::PendingBudget));
        $this->assertTrue($ticket->budget_requested);
        $this->assertEquals(BudgetStatusEnum::Pending->value, $ticket->budget_status);
        $this->assertEquals(500.00, (float) $ticket->budget_amount);
        $this->assertNotNull($ticket->budget_requested_at);
    }

    public function test_non_technician_cannot_request_budget(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget test ticket',
            'description' => 'Needs parts',
            'priority' => TicketPriorityEnum::Low->value,
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
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $inProgressId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget validation ticket',
            'description' => 'Testing validation',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
            'opened_at' => now(),
        ]);

        // Missing both required fields
        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/request-budget", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['budget_amount']);
    }

    public function test_admin_can_approve_budget(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $pendingId = app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget approval ticket',
            'description' => 'Testing budget approval',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
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
        $this->assertEquals(BudgetStatusEnum::Approved->value, $ticket->budget_status);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::InProgress));
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
        $this->assertNotNull($ticket->budget_decided_at);
    }

    public function test_admin_can_reject_budget(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $pendingId = app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget rejection ticket',
            'description' => 'Testing budget rejection',
            'priority' => TicketPriorityEnum::Low->value,
            'status_id' => $pendingId,
            'assigned_to' => $technician->id,
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
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
        $this->assertEquals(BudgetStatusEnum::Rejected->value, $ticket->budget_status);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Rejected));
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
    }

    public function test_non_admin_cannot_approve_budget(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $pendingId = app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Budget unauthorized ticket',
            'description' => 'Testing unauthorized budget decision',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => $pendingId,
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
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
