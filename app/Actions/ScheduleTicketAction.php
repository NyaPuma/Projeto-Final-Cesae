<?php

namespace App\Actions;

use App\DTOs\ScheduleTicketData;
use App\Models\Ticket;

final readonly class ScheduleTicketAction
{
    public function execute(Ticket $ticket, ScheduleTicketData $data): Ticket
    {
        $ticket->update([
            'scheduled_at' => $data->scheduledAt,
            'scheduled_end' => $data->scheduledEnd,
            'scheduled' => true,
        ]);

        return $ticket;
    }
}
