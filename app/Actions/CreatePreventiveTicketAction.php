<?php

namespace App\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;

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
    ): JsonResponse {
        $technician = $this->resolveTechnician($technicianId);
        if ($technicianId && ! $technician) {
            return response()->json(['message' => 'Técnico inválido'], 422);
        }

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'user_id' => $admin->id,
            'assigned_to' => $technician?->id,
            'title' => $title,
            'description' => $description ?? 'Manutenção preventiva agendada.',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'scheduled_at' => $scheduledAt,
            'scheduled' => true,
        ]);

        return response()->json(['ticket' => $ticket], 201);
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
