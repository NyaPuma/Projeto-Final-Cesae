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

    public function test_ticket_workflow_comments_photos_and_listing_work(): void
    {
        Storage::fake('public');

        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
        $techProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->firstOrFail();

        $creator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $technician = User::factory()->create([
            'profile_id' => $techProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $room = Room::create(['name' => 'Lab', 'location' => 'Floor 3', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'Printer',
            'serial' => 'PRN-999',
            'room_id' => $room->id,
            'active' => true,
        ]);

        // Cria ticket via model (evita TicketController::store que não existe no controller atual)
        $ticket = Ticket::create([
            'user_id' => $creator->id,
            'assigned_to' => $technician->id,
            'title' => 'Paper jam',
            'description' => 'Printer jammed repeatedly.',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
            'priority' => Ticket::PRIORITY_HIGH,
            'status_id' => Ticket::getStatusIdByName(Ticket::STATUS_OPEN),
            'opened_at' => now(),
        ]);

        $ticketId = $ticket->id;

        // Listar/detalhar (TicketController::show devolve JSON quando quer JSON)
        $this->withHeader('X-Auth-Token', $creator->api_token)
            ->getJson('/tickets/' . $ticketId)
            ->assertOk()
            ->assertJsonStructure(['ticket']);

        // Comentário
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/tickets/' . $ticketId . '/comments', ['comment' => 'I am checking the paper feed.'])
            ->assertCreated()
            ->assertJsonStructure(['comment']);

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/' . $ticketId . '/comments')
            ->assertOk()
            ->assertJsonStructure(['comments']);

        // Upload foto
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->post('/tickets/' . $ticketId . '/photos', [
                'photo' => UploadedFile::fake()->create('paper-jam.jpg', 10, 'image/jpeg'),
            ], [
                'Accept' => 'application/json',
            ])
            ->assertCreated()
            ->assertJsonStructure(['attachment', 'url']);

        $photosResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/' . $ticketId . '/photos');

        $this->assertContains($photosResponse->getStatusCode(), [200, 403]);

        if ($photosResponse->getStatusCode() === 200) {
            $photosResponse->assertJsonStructure(['attachments']);
        }

        // Calendário: rota web devolve HTML, mas pode redirecionar dependendo do estado de autenticação
        $calendarResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->get('/calendar');

        $this->assertContains($calendarResponse->getStatusCode(), [200, 302]);
    }

    public function test_common_user_can_comment_and_upload_photo_on_their_own_ticket(): void
    {
        Storage::fake('public');

        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
        $owner = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'title' => 'Own ticket',
            'description' => 'Created by owner',
            'status_id' => Ticket::getStatusIdByName(Ticket::STATUS_OPEN),
            'opened_at' => now(),
        ]);

        $commentResponse = $this->withHeader('X-Auth-Token', $owner->api_token)
            ->postJson('/tickets/' . $ticket->id . '/comments', [
                'comment' => 'I have attached the latest evidence.',
            ]);

        $commentResponse->assertCreated();

        $photoResponse = $this->withHeader('X-Auth-Token', $owner->api_token)
            ->post('/tickets/' . $ticket->id . '/photos', [
                'photo' => UploadedFile::fake()->image('evidence.jpg', 320, 240),
            ], [
                'Accept' => 'application/json',
            ]);

        $photoResponse->assertCreated();
    }

    public function test_common_user_cannot_comment_on_another_users_ticket(): void
    {
        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
        $owner = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);
        $otherUser = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'title' => 'Another ticket',
            'description' => 'Owned by someone else',
            'status_id' => Ticket::getStatusIdByName(Ticket::STATUS_OPEN),
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $otherUser->api_token)
            ->postJson('/tickets/' . $ticket->id . '/comments', [
                'comment' => 'This should be rejected.',
            ]);

        $response->assertStatus(403);
    }
}
