<?php

namespace Tests\Feature\API\Controllers;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketScheduleFeatureTest extends TestCase
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

    private function createTicket(User $user, string $status = TicketStatusEnum::Open->value): Ticket
    {
        return Ticket::create([
            'user_id' => $user->id,
            'title' => 'Equipamento com falha intermitente',
            'description' => 'A máquina falha ao arrancar.',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => TicketStatus::where('name', $status)->value('id'),
            'opened_at' => now(),
        ]);
    }

    public function test_technician_can_schedule_intervention(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
                'scheduled_end' => now()->addDays(2)->addHours(3)->format('Y-m-d\TH:i'),
            ]);

        $response->assertOk()
            ->assertJsonStructure(['message', 'ticket' => ['id', 'scheduled_at', 'scheduled_end', 'scheduled']]);

        $ticket->refresh();
        $this->assertTrue($ticket->scheduled);
        $this->assertNotNull($ticket->scheduled_at);
        $this->assertNotNull($ticket->scheduled_end);
    }

    public function test_schedule_requires_future_start(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => now()->subDay()->format('Y-m-d\TH:i'),
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['scheduled_at']);
    }

    public function test_schedule_rejects_end_before_start(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $scheduledAt = now()->addDays(2)->format('Y-m-d\TH:i');

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => $scheduledAt,
                'scheduled_end' => now()->addDays(1)->format('Y-m-d\TH:i'),
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['scheduled_end']);
    }

    public function test_cannot_schedule_closed_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user, TicketStatusEnum::Closed->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
            ]);

        $response->assertStatus(422);

        $ticket->refresh();
        $this->assertFalse((bool) $ticket->scheduled);
        $this->assertNull($ticket->scheduled_at);
    }

    public function test_cannot_schedule_cancelled_ticket(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user, TicketStatusEnum::Cancelled->value);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
            ]);

        $response->assertStatus(422);
    }

    public function test_schedule_validation_via_api(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/schedule', [
                'scheduled_at' => 'not-a-date',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['scheduled_at']);
    }

    public function test_technician_schedule_returns_same_status(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/schedule", [
                'scheduled_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
            ]);

        $response->assertOk()
            ->assertJsonPath('ticket.status_id', $openId);
    }

    public function test_schedule_validation_edge_cases(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket($user);

        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/schedule', $payload);

        // Test 1: missing scheduled_at
        $send([])->assertStatus(422)->assertJsonValidationErrors(['scheduled_at']);

        // Test 2: scheduled_end with invalid format
        $send([
            'scheduled_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
            'scheduled_end' => 'não-é-data',
        ])->assertStatus(422)->assertJsonValidationErrors(['scheduled_end']);

        // Test 3: scheduled_end equal to scheduled_at (must be later)
        $at = now()->addDays(2)->format('Y-m-d\TH:i');
        $send([
            'scheduled_at' => $at,
            'scheduled_end' => $at,
        ])->assertStatus(422)->assertJsonValidationErrors(['scheduled_end']);
    }
}
