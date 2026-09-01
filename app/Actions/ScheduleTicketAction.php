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
        if ($ticket->hasStatus(TicketStatusEnum::Closed) || $ticket->hasStatus(TicketStatusEnum::Cancelled)) {
            throw new InvalidArgumentException('Cannot schedule a ticket that is already closed.');
        }

        $scheduledAt = Carbon::parse($data->scheduledAt);
        $scheduledEnd = $data->scheduledEnd ? Carbon::parse($data->scheduledEnd) : null;

        if ($scheduledEnd !== null && $scheduledEnd->isBefore($scheduledAt)) {
            throw new InvalidArgumentException('Scheduled end time cannot be before the start time.');
        }

        return DB::transaction(function () use ($ticket, $scheduledAt, $scheduledEnd) {
            $ticket->update([
                'scheduled_at' => $scheduledAt,
                'scheduled_end' => $scheduledEnd,
                'scheduled' => true,
            ]);

            return $ticket->load(['technician', 'status']);
        });
    }
}
