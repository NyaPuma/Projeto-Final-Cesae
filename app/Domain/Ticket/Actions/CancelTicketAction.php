<?php

namespace App\Domain\Ticket\Actions;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use DomainException;

final readonly class CancelTicketAction
{
    public function __construct(
        private TicketStatusService $statusService,
    ) {}

    /**
     * Cancelar um ticket de suporte.
     *
     * @throws DomainException Se o ticket não puder ser cancelado
     */
    public function execute(Ticket $ticket, ?string $cancellationReason = null): bool
    {
        $cancelledStatusId = $this->statusService->getByName(TicketStatusEnum::Cancelled);

        // Guard Clause: Se já estiver cancelado, ignora ou lança exceção
        if ($ticket->status_id === $cancelledStatusId) {
            return true;
        }

        // Se tiveres lógica para impedir o cancelamento de tickets já encerrados:
        // if ($ticket->closed_at !== null) {
        //     throw new DomainException('Não é possível cancelar um ticket que já se encontra encerrado.');
        // }

        return DB::transaction(function () use ($ticket, $cancelledStatusId, $cancellationReason) {
            $ticket->status_id = $cancelledStatusId;
            $ticket->closed_at = now();

            if ($cancellationReason && $ticket->isFillable('cancellation_reason')) {
                $ticket->cancellation_reason = $cancellationReason;
            }

            $saved = $ticket->save();

            // Exemplo de disparo de evento para notificações/auditoria:
            // TicketCancelled::dispatch($ticket);

            return $saved;
        });
    }
}
