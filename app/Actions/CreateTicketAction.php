<?php

namespace App\Actions;

use App\DTOs\CreateTicketData;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;

final readonly class CreateTicketAction
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(User $user, CreateTicketData $data): Ticket
    {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        return Ticket::create([
            'title' => $data->title,
            'description' => $data->description,
            'priority' => $data->priority->value,
            'user_id' => $user->id,
            'equipment_id' => $data->equipmentId,
            'room_id' => $data->roomId,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);
    }
}
