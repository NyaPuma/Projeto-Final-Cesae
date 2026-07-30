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
     * Se o utilizador for técnico, restringe apenas aos seus tickets atribuídos.
     *
     * @param User $user
     * @return Collection<int, array<string, mixed>>
     */
    public function getScheduledEventsForUser(User $user): Collection
    {
        $query = Ticket::with(['equipment', 'equipment.category'])
            ->whereNotNull('scheduled_at')
            ->whereNull('deleted_at');

        if ($user->isTechnician()) {
            $query->where('assigned_to', $user->id);
        }

        return $query->get()->map(function (Ticket $ticket): array {
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
