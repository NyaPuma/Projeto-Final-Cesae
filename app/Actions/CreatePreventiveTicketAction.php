<?php

namespace App\Actions;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class CreatePreventiveTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(
        User $admin,
        string $title,
        ?string $description = null,
        User|int|null $technician = null,
        CarbonInterface|string|null $scheduledAt = null,
    ): Ticket {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        if ($openStatusId === null) {
            throw new RuntimeException("O estado '" . TicketStatusEnum::Open->value . "' não foi encontrado no sistema.");
        }

        $resolvedTechnician = $this->resolveTechnician($technician);

        return DB::transaction(function () use ($admin, $title, $description, $resolvedTechnician, $openStatusId, $scheduledAt) {
            $ticket = Ticket::create([
                'user_id' => $admin->id,
                'assigned_to' => $resolvedTechnician?->id,
                'title' => trim($title),
                'description' => $description ? trim($description) : 'Manutenção preventiva agendada.',
                'priority' => TicketPriorityEnum::Medium->value,
                'status_id' => $openStatusId,
                'opened_at' => now(),
                'scheduled_at' => $scheduledAt ? Carbon::parse($scheduledAt) : now(),
                'scheduled' => true,
            ]);

            // Exemplo de disparo de evento no futuro:
            // PreventiveTicketCreated::dispatch($ticket);

            return $ticket->load(['technician', 'status', 'user']);
        });
    }

    private function resolveTechnician(User|int|null $technician): ?User
    {
        if ($technician === null) {
            return null;
        }

        if ($technician instanceof User) {
            return $technician->isTechnician() ? $technician : null;
        }

        $user = User::find($technician);

        return ($user && $user->isTechnician()) ? $user : null;
    }
}
