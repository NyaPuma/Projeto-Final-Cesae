<?php

namespace App\Services;

use App\Domain\Ticket\Queries\ScheduledEventsQuery;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Collection;

final class CalendarService
{
    public function getScheduledEventsForUser(User $user): Collection
    {
        $query = Ticket::with(['equipment', 'equipment.category'])
            ->whereNotNull('scheduled_at')
            ->whereNull('deleted_at');

        if ($user->isTechnician()) {
            $query->where('assigned_to', $user->id);
        }

        return $query->get()->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'title' => $ticket->equipment->name ?? 'Avaria Geral',
                'start' => $ticket->scheduled_at->toIso8601String(),
                'end' => $ticket->scheduled_end?->toIso8601String(),
                'description' => $ticket->description,
                'url' => url("/ui/tickets/{$ticket->id}"),
            ];
        });
    }

    public function getScheduledEvents(?string $from = null, ?string $to = null): Collection
    {
        return (new ScheduledEventsQuery($from, $to))->execute();
    }
}
