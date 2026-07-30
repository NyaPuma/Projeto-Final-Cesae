<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
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

    public function test_ticket_title_with_special_characters(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Teste com acentos: çãõéíóú & símbolos: @#$% 123',
                'description' => 'Descrição com caracteres especiais: áéíóúçñ',
                'priority' => TicketPriorityEnum::Medium->value,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => 'Teste com acentos: çãõéíóú & símbolos: @#$% 123',
        ]);
    }

    public function test_ticket_title_maximum_length_boundary(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => str_repeat('A', 256),
                'description' => 'Valid description',
                'priority' => TicketPriorityEnum::Low->value,
            ]);

        $response->assertStatus(422);
    }

    public function test_ticket_title_exactly_255_characters(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $title = str_repeat('A', 255);
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => $title,
                'description' => 'Valid description at boundary',
                'priority' => TicketPriorityEnum::Medium->value,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', ['title' => $title]);
    }

    public function test_ticket_with_empty_description(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Ticket with empty description',
                'description' => '',
                'priority' => TicketPriorityEnum::Low->value,
            ]);

        $response->assertStatus(422);
    }

    public function test_ticket_with_invalid_priority_value(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Invalid priority test',
                'description' => 'Testing invalid priority',
                'priority' => 'urgentissima',
            ]);

        $response->assertStatus(422);
    }

    public function test_duplicate_equipment_serial_rejected(): void
    {
        $admin = $this->createUserWithToken(UserRoleEnum::Admin->value);

        $room = Room::factory()->create();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/equipment', [
                'name' => 'First Equipment',
                'serial' => 'SN-UNIQUE-001',
                'room_id' => $room->id,
            ])->assertStatus(201);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/equipment', [
                'name' => 'Duplicate Equipment',
                'serial' => 'SN-UNIQUE-001',
                'room_id' => $room->id,
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('serial');
    }

    public function test_ticket_with_nonexistent_room_reference(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'Ticket with invalid room',
                'description' => 'Testing invalid room reference',
                'priority' => TicketPriorityEnum::Medium->value,
                'room_id' => 99999,
            ]);

        $response->assertStatus(422);
    }

    public function test_unicode_ticket_title_and_description(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/tickets', [
                'title' => 'ðŸŒ Teste Unicode: ä½ å¥½ä¸–ç•Œ Olá Mundo ðŸŽ‰',
                'description' => 'Emoji test: ðŸ”§âš™ï¸ðŸ› ï¸ and Japanese: ãƒ¡ãƒ³ãƒ†ãƒŠãƒ³ã‚¹',
                'priority' => TicketPriorityEnum::High->value,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => 'ðŸŒ Teste Unicode: ä½ å¥½ä¸–ç•Œ Olá Mundo ðŸŽ‰',
        ]);
    }

    public function test_sql_injection_variants_in_fields(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $payloads = [
            '1; DROP TABLE tickets; --',
            "' OR '1'='1",
            "'; SELECT * FROM users; --",
            '" OR 1=1 --',
            '1 UNION SELECT * FROM users',
        ];

        foreach ($payloads as $payload) {
            $response = $this->withHeader('X-Auth-Token', $user->api_token)
                ->postJson('/api/tickets', [
                    'title' => 'SQLi test: '.substr($payload, 0, 50),
                    'description' => $payload,
                    'priority' => TicketPriorityEnum::Medium->value,
                ]);

            $response->assertStatus(201);
        }

        $this->assertEquals(5, Ticket::count());
    }
}
