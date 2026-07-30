<?php

namespace App\Services;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;

final class TechnicianAssignmentService
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function getLeastBusyTechnician(): ?User
    {
        $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        return User::whereHas('profile', fn ($q) => $q->where('name', User::ROLE_TECHNICIAN))
            ->where('active', true)
            ->withCount(['assignedTickets' => fn ($q) => $q->where('status_id', $inProgressStatusId)])
            ->orderBy('assigned_tickets_count', 'asc')
            ->first();
    }

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

        return $query->orderByRaw('CASE priority '.implode(' ', $cases).' ELSE 99 END')
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
