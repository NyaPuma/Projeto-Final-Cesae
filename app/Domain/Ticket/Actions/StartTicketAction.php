<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class StartTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket, ?User $user = null): bool
    {
        $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);

        if ($inProgressStatusId === null) {
            throw new RuntimeException("O estado '" . TicketStatusEnum::InProgress->value . "' não foi encontrado.");
        }

        // Guard Clause: Se o ticket já estiver em progresso, não altera nada
        if ($ticket->status_id === $inProgressStatusId) {
            return true;
        }

        return DB::transaction(function () use ($ticket, $inProgressStatusId, $user) {
            $ticket->status_id = $inProgressStatusId;
            $ticket->assigned_to = $ticket->assigned_to ?? $user?->id;

            // Preserva a data de arranque original caso já tenha sido iniciada antes
            $ticket->in_progress_at = $ticket->in_progress_at ?? now();

            $saved = $ticket->save();

            // Exemplo de disparo de evento para métricas/notificações:
            // TicketStarted::dispatch($ticket);

            return $saved;
        });
    }
}
