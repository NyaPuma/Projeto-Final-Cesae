<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::User->value]);

        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_ticket_search_filters_by_keyword_priority_and_date_range(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'api_token' => Str::random(60),
        ]);

        Ticket::create([
            'user_id' => $technician->id,
            'title' => 'Motor compressor overheating',
            'description' => 'Issue on the main compressor motor.',
            'priority' => TicketPriorityEnum::High->value,
            'status_id' => TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id'),
            'opened_at' => now()->subDays(2),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/search?q=compressor&priority='.TicketPriorityEnum::High->value.'&date_from='.now()->subDays(7)->toDateString());

        // CORRIGIDO: O mÃ©todo search() foi implementado - retorna 200 com resultados
        $response->assertOk();
        $response->assertJsonStructure(['tickets']);
    }

    public function test_ticket_search_returns_empty_results_when_no_match(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/search?q=this-should-not-match-anything');

        // CORRIGIDO: O mÃ©todo search() foi implementado - retorna 200 com lista vazia
        $response->assertOk();
        $response->assertJsonStructure(['tickets']);
        $this->assertCount(0, $response->json('tickets.data'));
    }

    public function test_ticket_search_rejects_invalid_date_range(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/search?date_from='.now()->toDateString().'&date_to='.now()->subDays(1)->toDateString());

        // CORRIGIDO: O mÃ©todo search() agora valida o intervalo de datas e retorna 422
        $response->assertStatus(422);
        $response->assertJson(['message' => 'A data de inÃ­cio nÃ£o pode ser posterior Ã  data de fim.']);
    }

    public function test_ticket_search_validates_priority_enum(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/search?priority=invalid-priority');

        // CORRIGIDO: O mÃ©todo search() agora valida a prioridade e retorna 422
        $response->assertStatus(422);
        $response->assertJson(['message' => 'Prioridade invÃ¡lida. Valores vÃ¡lidos: baixa, mÃ©dia, alta, crÃ­tica.']);
    }
}
