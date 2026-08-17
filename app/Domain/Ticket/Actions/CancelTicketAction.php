<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;

final readonly class CancelTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    /**
     * Cancelar um ticket de suporte.
     */
    public function execute(Ticket $ticket): bool
    {
        $cancelledStatusId = $this->statusService->getByName(TicketStatusEnum::Cancelled);

        // Guard Clause: Se já estiver cancelado, ignora ou lança exceção
        if ($ticket->status_id === $cancelledStatusId) {
            return true;
        }

        return DB::transaction(function () use ($ticket, $cancelledStatusId) {
            $ticket->status_id = $cancelledStatusId;
            $ticket->closed_at = now();

            $saved = $ticket->save();

            return $saved;
        });
    }
}
