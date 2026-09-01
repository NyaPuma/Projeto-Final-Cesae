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

        $resolvedTechnician = $this->resolveTechnician($technician);

        return DB::transaction(function () use ($admin, $title, $description, $resolvedTechnician, $openStatusId, $scheduledAt) {
            $ticket = Ticket::create([
                'user_id' => $admin->id,
                'assigned_to' => $resolvedTechnician?->id,
                'title' => trim($title),
                'description' => $description ? trim($description) : 'Scheduled preventive maintenance.',
                'priority' => TicketPriorityEnum::Medium->value,
                'status_id' => $openStatusId,
                'opened_at' => now(),
                'scheduled_at' => $scheduledAt ? Carbon::parse($scheduledAt) : now(),
                'scheduled' => true,
            ]);

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
