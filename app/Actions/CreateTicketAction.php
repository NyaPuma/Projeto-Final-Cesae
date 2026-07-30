<?php

namespace App\Actions;

use App\DTOs\CreateTicketData;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class CreateTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(User $user, CreateTicketData $data): Ticket
    {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        if ($openStatusId === null) {
            throw new RuntimeException("O estado '" . TicketStatusEnum::Open->value . "' não foi encontrado no sistema.");
        }

        return DB::transaction(function () use ($user, $data, $openStatusId) {
            $ticket = Ticket::create([
                'title' => trim($data->title),
                'description' => trim($data->description),
                'priority' => $data->priority->value,
                'user_id' => $user->id,
                'equipment_id' => $data->equipmentId,
                'room_id' => $data->roomId,
                'status_id' => $openStatusId,
                'opened_at' => now(),
            ]);

            // Exemplo de disparo de evento no futuro:
            // TicketCreated::dispatch($ticket);

            return $ticket->load(['user', 'equipment', 'room', 'status']);
        });
    }
}
