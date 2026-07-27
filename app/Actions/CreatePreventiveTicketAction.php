<?php

namespace App\Actions;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;

class CreatePreventiveTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(
        User $admin,
        string $title,
        ?string $description,
        ?int $technicianId,
        string $scheduledAt,
    ): Ticket {
        $technician = $this->resolveTechnician($technicianId);

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        return Ticket::create([
            'user_id' => $admin->id,
            'assigned_to' => $technician?->id,
            'title' => $title,
            'description' => $description ?? 'Manutenção preventiva agendada.',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'scheduled_at' => $scheduledAt,
            'scheduled' => true,
        ]);
    }

    private function resolveTechnician(?int $technicianId): ?User
    {
        if (! $technicianId) {
            return null;
        }

        $technician = User::find($technicianId);

        return ($technician && $technician->isTechnician()) ? $technician : null;
    }
}
