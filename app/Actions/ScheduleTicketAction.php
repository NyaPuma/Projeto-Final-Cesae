<?php

namespace App\Actions;

use App\DTOs\ScheduleTicketData;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final readonly class ScheduleTicketAction
{
    public function execute(Ticket $ticket, ScheduleTicketData $data): Ticket
    {
        // Guard Clause: Não permite agendar tickets já encerrados
        if ($ticket->hasStatus(TicketStatusEnum::Closed)) {
            throw new InvalidArgumentException("Não é possível agendar um ticket que já se encontra encerrado.");
        }

        $scheduledAt = Carbon::parse($data->scheduledAt);
        $scheduledEnd = $data->scheduledEnd ? Carbon::parse($data->scheduledEnd) : null;

        // Validação de intervalo temporal
        if ($scheduledEnd !== null && $scheduledEnd->isBefore($scheduledAt)) {
            throw new InvalidArgumentException("A data de término do agendamento não pode ser anterior à data de início.");
        }

        return DB::transaction(function () use ($ticket, $scheduledAt, $scheduledEnd) {
            $ticket->update([
                'scheduled_at' => $scheduledAt,
                'scheduled_end' => $scheduledEnd,
                'scheduled' => true,
            ]);

            // Exemplo de disparo de evento no futuro:
            // TicketScheduled::dispatch($ticket);

            return $ticket->load(['technician', 'status']);
        });
    }
}
