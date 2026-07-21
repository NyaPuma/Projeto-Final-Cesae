<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\EquipmentCategory;
use App\Services\AIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AIServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AIService $aiService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->aiService = new AIService();

        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_IN_PROGRESS, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CLOSED, 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CANCELLED, 'description' => 'Cancelado', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_returns_no_technician_when_none_available(): void
    {
        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title'       => 'AI Test Ticket',
            'description' => 'Testing AI with no technicians',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('não existem técnicos', $result['justificacao']);
    }

    #[Test]
    public function it_returns_fallback_when_ai_unavailable(): void
    {
        $technicianProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->first();
        $technician = User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active'     => true,
        ]);

        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title'       => 'AI Fallback Test',
            'description' => 'Testing AI fallback response',
            'priority'    => Ticket::PRIORITY_HIGH,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('indisponível', $result['justificacao']);
    }

    #[Test]
    public function it_ignores_inactive_technicians(): void
    {
        $technicianProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->first();

        User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active'     => false,
        ]);

        $category = EquipmentCategory::factory()->create();
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title'       => 'Inactive Tech Test',
            'description' => 'Should not recommend inactive tech',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('não existem técnicos', $result['justificacao']);
    }

    #[Test]
    public function it_handles_ticket_without_equipment(): void
    {
        $technicianProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->first();
        User::factory()->create([
            'profile_id' => $technicianProfile->id,
            'active'     => true,
        ]);

        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title'       => 'No Equipment Ticket',
            'description' => 'Ticket without equipment association',
            'priority'    => Ticket::PRIORITY_LOW,
            'user_id'     => $user->id,
            'equipment_id' => null,
            'room_id'     => null,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $result = $this->aiService->recomendarTecnico($ticket);

        $this->assertNull($result['tecnico_id']);
        $this->assertStringContainsString('indisponível', $result['justificacao']);
    }

    #[Test]
    public function it_returns_correct_result_structure(): void
    {
        $result = $this->aiService->recomendarTecnico(new Ticket());

        $this->assertArrayHasKey('tecnico_id', $result);
        $this->assertArrayHasKey('justificacao', $result);
    }
}
