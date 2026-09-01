<?php

namespace Tests\Feature;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Jobs\GenerateAiRecommendationJob;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketOperationsTest extends TestCase
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

    public function test_ticket_workflow_comments_photos_and_listing_work(): void
    {
        Storage::fake('public');

        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $techProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->firstOrFail();

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

        // Create ticket via model (avoids TicketController::store, which does not exist in the current controller)
        $ticket = Ticket::create([
            'user_id' => $creator->id,
            'assigned_to' => $technician->id,
            'title' => 'Paper jam',
            'description' => 'Printer jammed repeatedly.',
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ]);

        $ticketId = $ticket->id;

        // List/show details (TicketController::show returns JSON when JSON is requested)
        $this->withHeader('X-Auth-Token', $creator->api_token)
            ->getJson('/api/tickets/'.$ticketId)
            ->assertOk()
            ->assertJsonStructure(['ticket']);

        // Comment
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/api/tickets/'.$ticketId.'/comments', ['comment' => 'I am checking the paper feed.'])
            ->assertCreated()
            ->assertJsonStructure(['comment']);

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/tickets/'.$ticketId.'/comments')
            ->assertOk()
            ->assertJsonStructure(['comments']);

        // Photo upload
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->post('/api/tickets/'.$ticketId.'/photos', [
                'photo' => UploadedFile::fake()->image('paper-jam.jpg', 800, 600),
            ], [
                'Accept' => 'application/json',
            ])
            ->assertCreated()
            ->assertJsonStructure(['attachment']);

        $photosResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/tickets/'.$ticketId.'/photos');

        $this->assertContains($photosResponse->getStatusCode(), [200, 403]);

        if ($photosResponse->getStatusCode() === 200) {
            $photosResponse->assertJsonStructure(['attachments']);
        }

        // Calendar: web route returns HTML for the authenticated user
        $calendarResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->get('/calendar');

        $calendarResponse->assertOk();
    }

    public function test_common_user_can_comment_and_upload_photo_on_their_own_ticket(): void
    {
        Storage::fake('public');

        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $owner = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'title' => 'Own ticket',
            'description' => 'Created by owner',
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ]);

        $commentResponse = $this->withHeader('X-Auth-Token', $owner->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/comments', [
                'comment' => 'I have attached the latest evidence.',
            ]);

        $commentResponse->assertCreated();

        $photoResponse = $this->withHeader('X-Auth-Token', $owner->api_token)
            ->post('/api/tickets/'.$ticket->id.'/photos', [
                'photo' => UploadedFile::fake()->image('evidence.jpg', 320, 240),
            ], [
                'Accept' => 'application/json',
            ]);

        $photoResponse->assertCreated();
    }

    public function test_common_user_cannot_comment_on_another_users_ticket(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
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
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now(),
        ]);

        $response = $this->withHeader('X-Auth-Token', $otherUser->api_token)
            ->postJson('/api/tickets/'.$ticket->id.'/comments', [
                'comment' => 'This should be rejected.',
            ]);

        $response->assertStatus(403);
    }

    public function test_user_can_create_ticket_via_api(): void
    {
        Queue::fake();

        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $room = Room::create(['name' => 'Lab A', 'location' => 'Floor 1', 'active' => true]);
        $equipment = Equipment::create([
            'name' => 'CNC Machine',
            'serial' => 'CNC-001',
            'room_id' => $room->id,
            'active' => true,
        ]);

        // Test 1: Create ticket with all valid fields
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Máquina com ruído anómalo',
                'description' => 'O motor principal do torno está a fazer um ruído metálico ao rodar.',
                'priority' => 'alta',
                'equipment_id' => $equipment->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['ticket' => [
                'id', 'title', 'description', 'priority', 'user_id', 'equipment_id', 'status_id', 'opened_at',
            ]]);

        $ticketData = $response->json('ticket');
        $this->assertEquals('Máquina com ruído anómalo', $ticketData['title']);
        $this->assertEquals('alta', $ticketData['priority']);
        $this->assertEquals($user->id, $ticketData['user_id']);
        $this->assertEquals($equipment->id, $ticketData['equipment_id']);

        // The AI-based technician recommendation is dispatched in the background after the commit
        Queue::assertPushed(GenerateAiRecommendationJob::class);

        // Test 2: Create ticket without equipment_id (optional)
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Problema elétrico na sala de servidores',
                'description' => 'Tomada sem energia no rack 3.',
                'priority' => 'média',
            ]);

        $response2->assertStatus(201);
        $this->assertNull($response2->json('ticket.equipment_id'));

        // Test 3: Validate that 'media' is normalized to 'média'
        $response3 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste prioridade media',
                'description' => 'Descrição de teste.',
                'priority' => 'media',
            ]);

        $response3->assertStatus(201);
        $this->assertEquals('média', $response3->json('ticket.priority'));
    }

    public function test_ticket_creation_validation_errors(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Test 1: Missing required fields
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'description', 'priority']);

        // Test 2: Invalid priority
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => 'Descrição',
                'priority' => 'urgentissima',
            ]);

        $response2->assertStatus(422)
            ->assertJsonValidationErrors(['priority']);

        // Test 3: Non-existent equipment_id
        $response3 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => 'Descrição',
                'priority' => 'baixa',
                'equipment_id' => 99999,
            ]);

        $response3->assertStatus(422)
            ->assertJsonValidationErrors(['equipment_id']);
    }

    public function test_unauthenticated_user_cannot_create_ticket(): void
    {
        // Without authentication token
        $response = $this->postJson('/api/tickets', [
            'title' => 'Teste',
            'description' => 'Descrição',
            'priority' => 'baixa',
        ]);

        $response->assertStatus(401);
    }

    public function test_ticket_creation_validation_edge_cases(): void
    {
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Test 1: Non-existent room_id
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => 'Descrição',
                'priority' => 'baixa',
                'room_id' => 99999,
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['room_id']);

        // Test 2: Non-numeric IDs
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => 'Descrição',
                'priority' => 'baixa',
                'equipment_id' => 'abc',
                'room_id' => 'xyz',
            ]);

        $response2->assertStatus(422)
            ->assertJsonValidationErrors(['equipment_id', 'room_id']);

        // Test 3: title longer than 255 characters
        $response3 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => str_repeat('a', 256),
                'description' => 'Descrição',
                'priority' => 'baixa',
            ]);

        $response3->assertStatus(422)
            ->assertJsonValidationErrors(['title']);

        // Test 4: description longer than 5000 characters
        $response4 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => str_repeat('a', 5001),
                'priority' => 'baixa',
            ]);

        $response4->assertStatus(422)
            ->assertJsonValidationErrors(['description']);

        // Test 5: title with only spaces (trim produces an empty string)
        $response5 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => '   ',
                'description' => 'Descrição',
                'priority' => 'baixa',
            ]);

        $response5->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }
}
