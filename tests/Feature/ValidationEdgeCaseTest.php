<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ValidationEdgeCaseTest extends TestCase
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

    public function test_ticket_title_with_special_characters(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Teste com acentos: çãõéíóú & símbolos: @#$% 123',
                'description' => 'Descrição com caracteres especiais: áéíóúçñ',
                'priority' => Ticket::PRIORITY_MEDIUM,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => 'Teste com acentos: çãõéíóú & símbolos: @#$% 123',
        ]);
    }

    public function test_ticket_title_maximum_length_boundary(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => str_repeat('A', 256),
                'description' => 'Valid description',
                'priority' => Ticket::PRIORITY_LOW,
            ]);

        $response->assertStatus(422);
    }

    public function test_ticket_title_exactly_255_characters(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $title = str_repeat('A', 255);
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => $title,
                'description' => 'Valid description at boundary',
                'priority' => Ticket::PRIORITY_MEDIUM,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', ['title' => $title]);
    }

    public function test_ticket_with_empty_description(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Ticket with empty description',
                'description' => '',
                'priority' => Ticket::PRIORITY_LOW,
            ]);

        $response->assertStatus(422);
    }

    public function test_ticket_with_invalid_priority_value(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Invalid priority test',
                'description' => 'Testing invalid priority',
                'priority' => 'urgentissima',
            ]);

        $response->assertStatus(422);
    }

    public function test_duplicate_equipment_serial_rejected(): void
    {
        $admin = $this->createUserWithToken(User::ROLE_ADMIN);

        $room = Room::factory()->create();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/equipment', [
                'name' => 'First Equipment',
                'serial' => 'SN-UNIQUE-001',
                'room_id' => $room->id,
            ])->assertStatus(201);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/equipment', [
                'name' => 'Duplicate Equipment',
                'serial' => 'SN-UNIQUE-001',
                'room_id' => $room->id,
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('serial');
    }

    public function test_ticket_with_nonexistent_room_reference(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Ticket with invalid room',
                'description' => 'Testing invalid room reference',
                'priority' => Ticket::PRIORITY_MEDIUM,
                'room_id' => 99999,
            ]);

        $response->assertStatus(422);
    }

    public function test_unicode_ticket_title_and_description(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => '🌍 Teste Unicode: 你好世界 Olá Mundo 🎉',
                'description' => 'Emoji test: 🔧⚙️🛠️ and Japanese: メンテナンス',
                'priority' => Ticket::PRIORITY_HIGH,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => '🌍 Teste Unicode: 你好世界 Olá Mundo 🎉',
        ]);
    }

    public function test_sql_injection_variants_in_fields(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $payloads = [
            '1; DROP TABLE tickets; --',
            "' OR '1'='1",
            "'; SELECT * FROM users; --",
            '" OR 1=1 --',
            '1 UNION SELECT * FROM users',
        ];

        foreach ($payloads as $payload) {
            $response = $this->withHeader('X-Auth-Token', $user->api_token)
                ->postJson('/tickets', [
                    'title' => 'SQLi test: '.substr($payload, 0, 50),
                    'description' => $payload,
                    'priority' => Ticket::PRIORITY_MEDIUM,
                ]);

            $response->assertStatus(201);
        }

        $this->assertEquals(5, Ticket::count());
    }
}
