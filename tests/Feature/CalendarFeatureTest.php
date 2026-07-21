<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CalendarFeatureTest extends TestCase
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

    public function test_calendar_events_returns_scheduled_tickets(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Scheduled maintenance',
            'description' => 'Planned equipment check',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openId,
            'scheduled_at' => now()->addDays(3),
            'scheduled_end' => now()->addDays(3)->addHours(4),
            'scheduled' => true,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/calendar/events');

        $response->assertOk();
        $events = $response->json();
        $this->assertIsArray($events);
        $this->assertCount(1, $events);
        $this->assertEquals($ticket->id, $events[0]['id']);
        $this->assertStringContainsString('Scheduled maintenance', $events[0]['title']);
        $this->assertNotNull($events[0]['start']);
        $this->assertNotNull($events[0]['end']);
    }

    public function test_calendar_events_empty_when_no_scheduled_tickets(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/calendar/events');

        $response->assertOk();
        $events = $response->json();
        $this->assertIsArray($events);
        $this->assertCount(0, $events);
    }

    public function test_calendar_events_returns_correct_structure(): void
    {
        $user = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        Ticket::create([
            'user_id' => $user->id,
            'title' => 'Routine inspection',
            'description' => 'Monthly check',
            'priority' => Ticket::PRIORITY_LOW,
            'status_id' => $openId,
            'scheduled_at' => now()->addWeek(),
            'scheduled' => true,
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/calendar/events');

        $response->assertOk();
        $events = $response->json();
        $this->assertCount(1, $events);
        $this->assertArrayHasKey('id', $events[0]);
        $this->assertArrayHasKey('title', $events[0]);
        $this->assertArrayHasKey('start', $events[0]);
        $this->assertArrayHasKey('end', $events[0]);
    }
}
