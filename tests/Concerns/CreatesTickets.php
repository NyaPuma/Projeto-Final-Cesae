<?php

namespace Tests\Concerns;

use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Services\TicketStatusService;

trait CreatesTickets
{
    protected function createTicket(array $attributes = []): Ticket
    {
        $this->ensureTicketLookupData();

        $user = $attributes['user_id'] ?? User::factory()->create();
        $statusId = $attributes['status_id'] ?? app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        return Ticket::create(array_merge([
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $statusId,
            'opened_at' => now(),
        ], $attributes));
    }

    protected function createTicketWithEquipment(array $attributes = []): Ticket
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);

        return $this->createTicket(array_merge([
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
        ], $attributes));
    }

    protected function createTicketWithStatus(string $statusName, array $attributes = []): Ticket
    {
        $statusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::from($statusName));

        return $this->createTicket(array_merge([
            'status_id' => $statusId,
        ], $attributes));
    }

    protected function createTicketWithPriority(string $priority, array $attributes = []): Ticket
    {
        return $this->createTicket(array_merge([
            'priority' => $priority,
        ], $attributes));
    }

    protected function createScheduledTicket(array $attributes = []): Ticket
    {
        return $this->createTicket(array_merge([
            'scheduled' => true,
            'scheduled_at' => now()->addDays(1),
            'scheduled_end' => now()->addDays(1)->addHours(2),
        ], $attributes));
    }

    protected function createTicketWithBudget(array $attributes = []): Ticket
    {
        return $this->createTicket(array_merge([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 100.00,
            'budget_requested_at' => now(),
            'status_id' => app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget),
        ], $attributes));
    }

    protected function createTickets(int $count, array $attributes = []): array
    {
        $tickets = [];
        for ($i = 0; $i < $count; $i++) {
            $tickets[] = $this->createTicket($attributes);
        }

        return $tickets;
    }

    protected function ensureTicketLookupData(): void
    {
        TicketType::firstOrCreate(['name' => 'avaria'], ['code' => 'AVARIA', 'description' => 'Avaria']);
        TicketType::firstOrCreate(['name' => 'preventiva'], ['code' => 'PREVENTIVA', 'description' => 'Manutenção Preventiva']);

        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Open->value], ['code' => 'ABERTA', 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::InProgress->value], ['code' => 'EM_CURSO', 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Closed->value], ['code' => 'FECHADA', 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Cancelled->value], ['code' => 'CANCELADA', 'description' => 'Cancelado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::PendingBudget->value], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente Orçamento', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Rejected->value], ['code' => 'RECUSADA', 'description' => 'Recusada', 'type_id' => $typeId]);
    }
}
