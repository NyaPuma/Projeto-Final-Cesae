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
        $query = Ticket::with(['equipment', 'equipment.category', 'technician'])
            ->whereNotNull('scheduled_at')
            ->whereNull('deleted_at');

        if ($user->isTechnician()) {
            $query->where('assigned_to', $user->id);
        } elseif (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        return $query->get()->map(fn (Ticket $ticket): array => [
            'id' => $ticket->id,
            'title' => $ticket->title ?: ($ticket->equipment->name ?? 'General Fault'),
            'start' => $ticket->scheduled_at->toIso8601String(),
            'end' => $ticket->scheduled_end?->toIso8601String(),
            'description' => $ticket->description,
            'url' => url("/ui/tickets/{$ticket->id}"),
            'scheduled' => true,
            'equipment' => $ticket->equipment?->name,
            'technician' => $ticket->technician?->name,
            'editable' => $user->isAdmin() || ($user->isTechnician() && $ticket->assigned_to === $user->id),
        ]);
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
