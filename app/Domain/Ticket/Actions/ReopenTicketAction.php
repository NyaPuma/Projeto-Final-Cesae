<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

final readonly class ReopenTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket): bool
    {
        // Guard Clause: Apenas tickets fechados ou cancelados podem ser reabertos
        if (! $ticket->hasStatus(TicketStatusEnum::Closed) && ! $ticket->hasStatus(TicketStatusEnum::Cancelled)) {
            return false;
        }

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        // Se o estado não existir no sistema, deve abortar imediatamente antes de mutar a entidade
        if ($openStatusId === null) {
            throw new RuntimeException("O estado '" . TicketStatusEnum::Open->value . "' não foi encontrado.");
        }

        return DB::transaction(function () use ($ticket, $openStatusId) {
            $ticket->status_id = $openStatusId;
            $ticket->reopened_at = now();
            $ticket->closed_at = null;

            $saved = $ticket->save();

            // Exemplo de disparo de evento para notificações:
            // TicketReopened::dispatch($ticket);

            return $saved;
        });
    }
}
