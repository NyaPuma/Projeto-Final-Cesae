<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CalendarFeatureTest extends TestCase
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

    public function test_calendar_events_returns_scheduled_tickets(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Scheduled maintenance',
            'description' => 'Planned equipment check',
            'priority' => TicketPriorityEnum::Medium->value,
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
        $this->assertNotNull($events[0]['title']);
        $this->assertNotNull($events[0]['start']);
        $this->assertNotNull($events[0]['end']);
    }

    public function test_calendar_events_empty_when_no_scheduled_tickets(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/calendar/events');

        $response->assertOk();
        $events = $response->json();
        $this->assertIsArray($events);
        $this->assertCount(0, $events);
    }

    public function test_calendar_events_returns_correct_structure(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        Ticket::create([
            'user_id' => $user->id,
            'title' => 'Routine inspection',
            'description' => 'Monthly check',
            'priority' => TicketPriorityEnum::Low->value,
            'status_id' => $openId,
            'assigned_to' => $user->id,
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
