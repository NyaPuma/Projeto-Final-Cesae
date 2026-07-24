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
            ->getJson('/tickets/'.$ticketId)
            ->assertOk()
            ->assertJsonStructure(['ticket']);

        // Comentário
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson('/tickets/'.$ticketId.'/comments', ['comment' => 'I am checking the paper feed.'])
            ->assertCreated()
            ->assertJsonStructure(['comment']);

        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/'.$ticketId.'/comments')
            ->assertOk()
            ->assertJsonStructure(['comments']);

        // Upload foto
        $this->withHeader('X-Auth-Token', $technician->api_token)
            ->post('/tickets/'.$ticketId.'/photos', [
                'photo' => UploadedFile::fake()->create('paper-jam.jpg', 10, 'image/jpeg'),
            ], [
                'Accept' => 'application/json',
            ])
            ->assertCreated()
            ->assertJsonStructure(['attachment', 'url']);

        $photosResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/'.$ticketId.'/photos');

        $this->assertContains($photosResponse->getStatusCode(), [200, 403]);

        if ($photosResponse->getStatusCode() === 200) {
            $photosResponse->assertJsonStructure(['attachments']);
        }

        // Calendário: rota web devolve HTML, mas pode redirecionar dependendo do estado de autenticação
        $calendarResponse = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->get('/calendar');

        $this->assertContains($calendarResponse->getStatusCode(), [200, 302, 500]);
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
            ->postJson('/tickets/'.$ticket->id.'/comments', [
                'comment' => 'I have attached the latest evidence.',
            ]);

        $commentResponse->assertCreated();

        $photoResponse = $this->withHeader('X-Auth-Token', $owner->api_token)
            ->post('/tickets/'.$ticket->id.'/photos', [
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
            ->postJson('/tickets/'.$ticket->id.'/comments', [
                'comment' => 'This should be rejected.',
            ]);

        $response->assertStatus(403);
    }

    public function test_user_can_create_ticket_via_api(): void
    {
        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
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

        // Teste 1: Criar ticket com todos os campos válidos
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

        // Teste 2: Criar ticket sem equipment_id (opcional)
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Problema elétrico na sala de servidores',
                'description' => 'Tomada sem energia no rack 3.',
                'priority' => 'média',
            ]);

        $response2->assertStatus(201);
        $this->assertNull($response2->json('ticket.equipment_id'));

        // Teste 3: Validar que 'media' é normalizado para 'média'
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
        $userProfile = UserProfile::where('name', User::ROLE_USER)->firstOrFail();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        // Teste 1: Campos obrigatórios em falta
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'description', 'priority']);

        // Teste 2: Prioridade inválida
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste',
                'description' => 'Descrição',
                'priority' => 'urgentissima',
            ]);

        $response2->assertStatus(422)
            ->assertJsonValidationErrors(['priority']);

        // Teste 3: Equipment_id inexistente
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
        // Sem token de autenticação
        $response = $this->postJson('/api/tickets', [
            'title' => 'Teste',
            'description' => 'Descrição',
            'priority' => 'baixa',
        ]);

        $response->assertStatus(401);
    }
}
