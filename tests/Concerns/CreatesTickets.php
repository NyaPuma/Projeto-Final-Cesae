<?php

namespace Tests\Concerns;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;

trait CreatesTickets
{
    protected function createTicket(array $attributes = []): Ticket
    {
        $this->ensureTicketLookupData();

        $user = $attributes['user_id'] ?? User::factory()->create();
        $statusId = $attributes['status_id'] ?? Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        return Ticket::create(array_merge([
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => Ticket::PRIORITY_MEDIUM,
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
        $statusId = Ticket::getStatusIdByName($statusName);

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
            'budget_status' => Ticket::BUDGET_PENDING,
            'budget_amount' => 100.00,
            'budget_requested_at' => now(),
            'status_id' => Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET),
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
        TicketType::firstOrCreate(['name' => 'avaria'], ['description' => 'Avaria']);
        TicketType::firstOrCreate(['name' => 'preventiva'], ['description' => 'Manutenção Preventiva']);

        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_IN_PROGRESS, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CLOSED, 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CANCELLED, 'description' => 'Cancelado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_PENDING_BUDGET, 'description' => 'Pendente Orçamento', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_REJECTED, 'description' => 'Recusada', 'type_id' => $typeId]);
    }
}
