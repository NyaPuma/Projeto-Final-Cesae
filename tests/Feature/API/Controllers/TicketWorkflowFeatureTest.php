<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketWorkflowFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);

        // Flush the status cache to ensure fresh data for each test
        app(TicketStatusService::class)->flush();
    }

    private function createUserWithToken(string $profileName, bool $active = true): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => $active,
        ]);
    }

    private function createTicket(User $user, array $overrides = []): Ticket
    {
        $data = array_merge([
            'user_id' => $user->id,
            'title' => 'Test equipment fault',
            'description' => 'Equipment making unusual noise',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ], $overrides);

        return Ticket::create($data);
    }

    public function test_technician_can_start_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/api/technician/tickets/{$ticket->id}/start");

        $response->assertOk()
            ->assertJsonStructure(['ticket' => [
                'id', 'status_id', 'assigned_to', 'in_progress_at',
            ]]);

        $ticket->refresh();
        $this->assertEquals($technician->id, $ticket->assigned_to);
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::InProgress));
        $this->assertNotNull($ticket->in_progress_at);
    }

    public function test_non_technician_cannot_start_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->putJson("/api/technician/tickets/{$ticket->id}/start");

        $response->assertStatus(403);
    }

    public function test_cannot_start_non_open_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $inProgressId = TicketStatus::where('name', TicketStatusEnum::InProgress->value)->value('id');
        $ticket = $this->createTicket($user, ['status_id' => $inProgressId]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/api/technician/tickets/{$ticket->id}/start");

        $response->assertStatus(422);
    }

    public function test_technician_can_close_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $inProgressId = TicketStatus::where('name', TicketStatusEnum::InProgress->value)->value('id');
        $ticket = $this->createTicket($user, [
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now()->subHours(2),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/api/technician/tickets/{$ticket->id}/close", [
                'minutes_spent' => 120,
                'cost' => 150.50,
                'technical_report' => 'Replaced faulty bearing',
            ]);

        $response->assertOk()
            ->assertJsonStructure(['ticket' => [
                'id', 'status_id', 'closed_at', 'minutes_spent',
            ]]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Closed));
        $this->assertEquals(120, $ticket->minutes_spent);
        $this->assertEquals(150.50, (float) $ticket->actual_cost);
        $this->assertEquals('Replaced faulty bearing', $ticket->technical_report);
    }

    public function test_cannot_close_non_in_progress_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/api/technician/tickets/{$ticket->id}/close");

        $response->assertStatus(422);
    }

    public function test_technician_can_reopen_closed_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $closedId = TicketStatus::where('name', TicketStatusEnum::Closed->value)->value('id');
        $ticket = $this->createTicket($user, [
            'status_id' => $closedId,
            'closed_at' => now()->subDay(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/api/tickets/{$ticket->id}/reopen");

        $response->assertOk()
            ->assertJsonStructure(['ticket' => ['id', 'status_id']]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Open));
        $this->assertNotNull($ticket->reopened_at);
    }

    public function test_cannot_reopen_non_closed_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/api/tickets/{$ticket->id}/reopen");

        $response->assertStatus(422);
    }

    public function test_user_can_cancel_own_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson("/api/tickets/{$ticket->id}/cancel");

        $response->assertOk();
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Cancelled));
        $this->assertNotNull($ticket->closed_at);
    }

    public function test_user_cannot_cancel_another_users_ticket(): void
    {
        $user1 = $this->createUserWithToken(UserRoleEnum::User->value);
        $user2 = $this->createUserWithToken(UserRoleEnum::User->value);
        $ticket = $this->createTicket($user1);

        $response = $this->withHeader('X-Auth-Token', $user2->api_token)
            ->postJson("/api/tickets/{$ticket->id}/cancel");

        $response->assertStatus(403);
    }
}
