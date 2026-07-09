<?php

namespace Tests\Feature;

use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class RealtimeBroadcastTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        \App\Models\UserProfile::create(['name' => User::ROLE_USER]);
        \App\Models\UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        \App\Models\UserProfile::create(['name' => User::ROLE_ADMIN]);

        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_ticket_creation_emits_realtime_broadcast_event(): void
    {
        Event::fake();

        $profile = \App\Models\UserProfile::where('name', User::ROLE_USER)->first();

        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Teste realtime',
                'description' => 'Ticket para testar broadcast.',
            ]);

        $response->assertStatus(201);

        Event::assertDispatched(TicketCreatedBroadcast::class);
    }

    public function test_ticket_status_change_emits_realtime_broadcast_event(): void
    {
        Event::fake();

        $technicianProfile = \App\Models\UserProfile::where('name', User::ROLE_TECHNICIAN)->first();
        $userProfile = \App\Models\UserProfile::where('name', User::ROLE_USER)->first();

        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'api_token' => Str::random(60),
        ]);

        $creator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'user_id' => $creator->id,
            'title' => 'Ticket realtime status',
            'description' => 'Status update check.',
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson('/technician/tickets/' . $ticket->id . '/start')
            ->assertOk();

        Event::assertDispatched(TicketStatusUpdatedBroadcast::class);
    }
}
