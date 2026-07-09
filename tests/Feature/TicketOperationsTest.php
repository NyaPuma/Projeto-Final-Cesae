<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketOperationsTest extends TestCase
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

    public function test_ticket_workflow_comments_photos_schedule_and_listing_work(): void
    {
        Storage::fake('public');

        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
        $techProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->firstOrFail();
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->firstOrFail();

        $creator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);
        $technician = User::factory()->create([
            'profile_id' => $techProfile->id,
            'api_token' => Str::random(60),
        ]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $room = Room::create(['name' => 'Lab', 'location' => 'Floor 3', 'active' => true]);
        $equipment = Equipment::create(['name' => 'Printer', 'serial' => 'PRN-999', 'room_id' => $room->id, 'active' => true]);

        $created = $this->withHeader('X-Auth-Token', $creator->api_token)->postJson('/tickets', [
            'title' => 'Paper jam',
            'description' => 'Printer jammed repeatedly.',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
            'priority' => Ticket::PRIORITY_HIGH,
        ]);

        $created->assertCreated();
        $ticketId = $created->json('ticket.id');

        $this->withHeader('X-Auth-Token', $creator->api_token)
            ->getJson('/tickets/' . $ticketId)
            ->assertOk();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->putJson('/technician/tickets/' . $ticketId . '/start')
            ->assertOk();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/tickets/' . $ticketId . '/comments', ['comment' => 'I am checking the paper feed.'])
            ->assertCreated();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/' . $ticketId . '/comments')
            ->assertOk();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/tickets/' . $ticketId . '/photos', [
                'photo' => UploadedFile::fake()->create('paper-jam.jpg', 10, 'image/jpeg'),
            ])
            ->assertCreated();

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/' . $ticketId . '/photos')
            ->assertOk();

        $schedule = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/tickets/' . $ticketId . '/schedule', [
                'start' => now()->addDay()->toDateTimeString(),
                'end' => now()->addDay()->addHour()->toDateTimeString(),
                'technician_id' => $technician->id,
            ]);
        $schedule->assertOk();

        $calendar = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/calendar/events');
        $calendar->assertOk();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/tickets/' . $ticketId . '/assign-technician', ['technician_id' => $technician->id])
            ->assertOk();

        $this->withHeader('X-Auth-Token', $creator->api_token)
            ->getJson('/tickets/search?q=paper')
            ->assertOk();
    }
}
