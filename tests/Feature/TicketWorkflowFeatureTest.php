<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketWorkflowFeatureTest extends TestCase
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
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => Ticket::getStatusIdByName(Ticket::STATUS_OPEN),
            'opened_at' => now(),
        ], $overrides);

        return Ticket::create($data);
    }

    public function test_technician_can_start_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/start");

        $response->assertOk()
            ->assertJsonStructure(['ticket' => [
                'id', 'status_id', 'assigned_to', 'in_progress_at'
            ]]);

        $ticket->refresh();
        $this->assertEquals($technician->id, $ticket->assigned_to);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_IN_PROGRESS));
        $this->assertNotNull($ticket->in_progress_at);
    }

    public function test_non_technician_cannot_start_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/start");

        $response->assertStatus(403);
    }

    public function test_cannot_start_non_open_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $ticket = $this->createTicket($user, ['status_id' => $inProgressId]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/start");

        $response->assertStatus(422);
    }

    public function test_technician_can_close_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $ticket = $this->createTicket($user, [
            'status_id' => $inProgressId,
            'assigned_to' => $technician->id,
            'in_progress_at' => now()->subHours(2),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/close", [
                'minutes_spent' => 120,
                'cost' => 150.50,
                'technical_report' => 'Replaced faulty bearing',
            ]);

        $response->assertOk()
            ->assertJsonStructure(['ticket' => [
                'id', 'status_id', 'closed_at', 'minutes_spent', 'cost', 'technical_report'
            ]]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_CLOSED));
        $this->assertEquals(120, $ticket->minutes_spent);
        $this->assertEquals(150.50, (float) $ticket->cost);
        $this->assertEquals('Replaced faulty bearing', $ticket->technical_report);
    }

    public function test_cannot_close_non_in_progress_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson("/technician/tickets/{$ticket->id}/close");

        $response->assertStatus(422);
    }

    public function test_technician_can_reopen_closed_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $closedId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        $ticket = $this->createTicket($user, [
            'status_id' => $closedId,
            'closed_at' => now()->subDay(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/reopen");

        $response->assertOk()
            ->assertJsonStructure(['ticket' => ['id', 'status_id', 'reopened_at']]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_OPEN));
        $this->assertNotNull($ticket->reopened_at);
    }

    public function test_cannot_reopen_non_closed_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/reopen");

        $response->assertStatus(422);
    }

    public function test_user_can_cancel_own_ticket(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson("/tickets/{$ticket->id}/cancel");

        $response->assertOk();
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_CANCELLED));
        $this->assertNotNull($ticket->closed_at);
    }

    public function test_user_cannot_cancel_another_users_ticket(): void
    {
        $user1 = $this->createUserWithToken(User::ROLE_USER);
        $user2 = $this->createUserWithToken(User::ROLE_USER);
        $ticket = $this->createTicket($user1);

        $response = $this->withHeader('X-Auth-Token', $user2->api_token)
            ->postJson("/tickets/{$ticket->id}/cancel");

        $response->assertStatus(403);
    }
}
