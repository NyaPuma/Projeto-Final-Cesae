<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Ticket\Actions\CancelTicketAction;
use App\Domain\Ticket\Actions\CheckHigherPriorityAction;
use App\Domain\Ticket\Actions\CloseTicketAction;
use App\Domain\Ticket\Actions\ReopenTicketAction;
use App\Domain\Ticket\Actions\StartTicketAction;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class TicketWorkflowService
{
    /**
     * @param TicketStatusService $statusService
     * @param StartTicketAction $startAction
     * @param CloseTicketAction $closeAction
     * @param ReopenTicketAction $reopenAction
     * @param CancelTicketAction $cancelAction
     * @param CheckHigherPriorityAction $checkHigherPriorityAction
     */
    public function __construct(
        private readonly TicketStatusService $statusService,
        private readonly StartTicketAction $startAction,
        private readonly CloseTicketAction $closeAction,
        private readonly ReopenTicketAction $reopenAction,
        private readonly CancelTicketAction $cancelAction,
        private readonly CheckHigherPriorityAction $checkHigherPriorityAction,
    ) {}

    /**
     * Inicia a reparação de um ticket.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function startRepair(Ticket $ticket, ?User $user = null): bool
    {
        return $this->startAction->execute($ticket, $user);
    }

    /**
     * Reabre um ticket anteriormente fechado ou cancelado.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function reopen(Ticket $ticket): bool
    {
        return $this->reopenAction->execute($ticket);
    }

    /**
     * Cancela um ticket.
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function cancel(Ticket $ticket): bool
    {
        return $this->cancelAction->execute($ticket);
    }

    /**
     * Fecha um ticket com os dados de custo, relatório e tempo gasto dentro de uma transação.
     *
     * @param Ticket $ticket
     * @param float|null $cost
     * @param string|null $report
     * @param int|null $minutesSpent
     * @return bool
     */
    public function close(Ticket $ticket, ?float $cost = null, ?string $report = null, ?int $minutesSpent = null): bool
    {
        return DB::transaction(fn (): bool => $this->closeAction->execute($ticket, $cost, $report, $minutesSpent));
    }

    /**
     * Verifica se o ticket pode ser auto-fechado com base no limiar de custo definido.
     *
     * @param Ticket $ticket
     * @param float $threshold
     * @return bool
     */
    public function checkAutoClose(Ticket $ticket, float $threshold): bool
    {
        if ($ticket->estimated_cost === null || $ticket->estimated_cost > $threshold) {
            return false;
        }

        $statusId = $this->statusService->getByName(TicketStatusEnum::Closed);

        if ($statusId !== null) {
            $ticket->status_id = $statusId;
        }

        $ticket->closed_at = now();

        return $ticket->save();
    }

    /**
     * Encontra tickets com prioridade superior associados ao contexto.
     *
     * @param Ticket $ticket
     * @return array<int, mixed>
     */
    public function findHigherPriorityTickets(Ticket $ticket): array
    {
        return $this->checkHigherPriorityAction->execute($ticket);
    }
}
