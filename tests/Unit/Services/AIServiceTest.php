<?php

namespace Tests\Unit;


use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\AIService;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AIServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AIService $aiService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->aiService = new AIService(
            statusService: app(TicketStatusService::class),
        );

        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Open->value, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::InProgress->value, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Closed->value, 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Cancelled->value, 'description' => 'Cancelado', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
    }

    #[Test]
    public function it_returns_no_technician_when_none_available(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'AI Test Ticket',
            'description' => 'Testing AI with no technicians',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('nÃ£o existem tÃ©cnicos', $result['justificacao']);
    }

    #[Test]
    public function it_returns_fallback_when_ai_unavailable(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();
        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active' => true,
        ]);

        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'AI Fallback Test',
            'description' => 'Testing AI fallback response',
            'priority' => TicketPriorityEnum::High->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('indisponÃ­vel', $result['justificacao']);
    }

    #[Test]
    public function it_ignores_inactive_technicians(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();

        User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active' => false,
        ]);

        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'Inactive Tech Test',
            'description' => 'Should not recommend inactive tech',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('nÃ£o existem tÃ©cnicos', $result['justificacao']);
    }

    #[Test]
    public function it_handles_ticket_without_equipment(): void
    {
        $technicianProfile = UserProfile::where('name', UserRoleEnum::Technician->value)->first();
        User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active' => true,
        ]);

        $user = User::factory()->create();
        $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => 'No Equipment Ticket',
            'description' => 'Ticket without equipment association',
            'priority' => TicketPriorityEnum::Low->value,
            'user_id' => $user->id,
            'equipment_id' => null,
            'room_id' => null,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('indisponÃ­vel', $result['justificacao']);
    }

    #[Test]
    public function it_returns_correct_result_structure(): void
    {
        $result = $this->aiService->recomendarTecnico(new Ticket);

        $this->assertArrayHasKey('tecnico_id', $result);
        $this->assertArrayHasKey('justificacao', $result);
    }
}
