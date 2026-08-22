<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;

final class TechnicianAssignmentService
{
    /**
     * @param TicketStatusService $statusService
     */
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    /**
     * Finds the active technician with the lowest workload (in-progress tickets).
     *
     * @return User|null
     */
    public function getLeastBusyTechnician(): ?User
    {
        $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        return User::whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Technician->value))
            ->where('active', true)
            ->withCount(['assignedTickets' => fn ($q) => $q->where('status_id', $inProgressStatusId)])
            ->orderBy('assigned_tickets_count', 'asc')
            ->first();
    }

    /**
     * Assigns a technician to a ticket (specific by ID or automatically the least busy).
     *
     * @param Ticket $ticket
     * @param int|null $technicianId
     * @return User|null
     */
    public function assignToTicket(Ticket $ticket, ?int $technicianId): ?User
    {
        if ($technicianId !== null) {
            $technician = User::find($technicianId);

            if (! $technician || ! $technician->isTechnician()) {
                return null;
            }

            $ticket->assigned_to = $technician->id;
            $ticket->save();

            return $technician;
        }

        $technician = $this->getLeastBusyTechnician();

        if (! $technician) {
            return null;
        }

        $ticket->assigned_to = $technician->id;
        $ticket->save();

        return $technician;
    }

    /**
     * Encontra o ticket aberto mais urgente com base na prioridade e na data de criação.
     *
     * @param int|null $excludeId
     * @return Ticket|null
     */
    public function findMostUrgentOpenTicket(?int $excludeId = null): ?Ticket
    {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        $query = Ticket::where('status_id', $openStatusId);

        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }

        $reversed = array_reverse(TicketPriorityEnum::cases());
        $cases = array_map(
            fn (TicketPriorityEnum $p, int $i) => "WHEN '{$p->value}' THEN {$i}",
            $reversed,
            array_keys($reversed)
        );

        return $query->orderByRaw('CASE priority ' . implode(' ', $cases) . ' ELSE 99 END')
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
