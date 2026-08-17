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
     * Obtém os eventos agendados formatados para um utilizador específico.
     * - Admin vê todos os agendamentos;
     * - Técnico vê apenas os seus tickets atribuídos;
     * - Utilizador comum vê apenas os seus próprios tickets.
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
            'title' => $ticket->title ?: ($ticket->equipment->name ?? 'Avaria Geral'),
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
     * Obtém os eventos agendados globais dentro de um intervalo de datas opcional.
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
