<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Ticket\Queries\ScheduledEventsQuery;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Collection;

final class CalendarService
{
    /**
     * Gets formatted scheduled events for a specific user.
     * - Admin sees all schedules;
     * - Technician sees only their assigned tickets;
     * - Regular user sees only their own tickets.
     *
     * @param User $user
     * @return Collection<int, array<string, mixed>>
     */
    public function getScheduledEventsForUser(User $user): Collection
    {
        $baseQuery = Ticket::with(['equipment', 'equipment.category', 'technician'])
            ->whereNull('deleted_at');

        if ($user->isTechnician()) {
            $baseQuery->where('assigned_to', $user->id);
        } elseif (! $user->isAdmin()) {
            $baseQuery->where('user_id', $user->id);
        }

        $tickets = $baseQuery->get();

        return $tickets->map(function (Ticket $ticket) use ($user): array {
            $start = $ticket->scheduled_at ?? $ticket->opened_at ?? $ticket->resolved_at;

            if (! $start) {
                return [];
            }

            $isScheduled = (bool) $ticket->scheduled_at;

            return [
                'id' => $ticket->id,
                'title' => $ticket->title ?: ($ticket->equipment->name ?? 'General Fault'),
                'start' => $start->toIso8601String(),
                'end' => $isScheduled ? ($ticket->scheduled_end?->toIso8601String()) : null,
                'extendedProps' => [
                    'url' => url("/ui/tickets/{$ticket->id}"),
                    'scheduled' => $isScheduled,
                    'equipment' => $ticket->equipment?->name,
                    'technician' => $ticket->technician?->name,
                    'description' => $ticket->description,
                ],
                'editable' => $user->isAdmin() || ($user->isTechnician() && $ticket->assigned_to === $user->id),
            ];
        })->filter()->values();
    }

    /**
     * Gets global scheduled events within an optional date range.
     *
     * @param string|null $from
     * @param string|null $to
     * @return Collection<int, array<string, mixed>>
     */
    public function getScheduledEvents(?string $from = null, ?string $to = null): Collection
    {
        return (new ScheduledEventsQuery($from, $to))->execute();
    }
}
