<?php

namespace App\Domain\Ticket\Queries;

use App\Enums\TicketPriorityEnum;
use Illuminate\Database\Eloquent\Builder;

final readonly class TicketPriorityQuery
{
    public function __construct(
        private Builder $baseQuery,
    ) {}

    public function execute(): array
    {
        // clone para evitar mutação indesejada da $baseQuery original
        $row = (clone $this->baseQuery)
            ->selectRaw('
                SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as low,
                SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as medium,
                SUM(CASE WHEN priority IN (?, ?) THEN 1 ELSE 0 END) as high
            ', [
                TicketPriorityEnum::Low->value,
                TicketPriorityEnum::Medium->value,
                TicketPriorityEnum::High->value,
                TicketPriorityEnum::Critical->value,
            ])
            ->first();

        return [
            'low' => (int) ($row->low ?? 0),
            'medium' => (int) ($row->medium ?? 0),
            'high' => (int) ($row->high ?? 0),
        ];
    }
}
