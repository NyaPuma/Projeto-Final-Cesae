<?php

namespace App\Domain\Ticket\Queries;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final readonly class ScheduledEventsQuery
{
    public function __construct(
        private ?string $from = null,
        private ?string $to = null,
    ) {}

    public function execute(): Collection
    {
        $query = Ticket::query()
            ->whereNotNull('scheduled_at')
            ->select('id', 'title', 'scheduled_at', 'scheduled_end');

        if ($this->from) {
            $query->where('scheduled_at', '>=', $this->from);
        }

        if ($this->to) {
            $query->where('scheduled_at', '<=', $this->to);
        }

        return $query->get()->map(fn ($ticket) => [
            'id' => $ticket->id,
            'title' => '#' . $ticket->id . ' - ' . $ticket->title,
            'start' => Carbon::parse($ticket->scheduled_at)->toIso8601String(),
            'end' => $ticket->scheduled_end ? Carbon::parse($ticket->scheduled_end)->toIso8601String() : null,
        ]);
    }
}
