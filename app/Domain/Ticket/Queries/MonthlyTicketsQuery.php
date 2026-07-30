<?php

namespace App\Domain\Ticket\Queries;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final readonly class MonthlyTicketsQuery
{
    public function __construct(
        private int $openStatusId,
        private int $inProgressStatusId,
        private int $closedStatusId,
        private Carbon $now,
    ) {}

    public function execute(): array
    {
        $monthKeys = $this->generateMonthKeys();
        $rows = $this->buildQuery($monthKeys)->keyBy('month');

        return $this->formatResults($monthKeys, $rows);
    }

    private function generateMonthKeys(): array
    {
        $keys = [];
        foreach (range(5, 0) as $offset) {
            $keys[] = $this->now->copy()->subMonths($offset)->format('Y-m');
        }

        return $keys;
    }

    private function buildQuery(array $monthKeys): Collection
    {
        $startMonth = $this->now->copy()->subMonths(5)->startOfMonth()->toDateTimeString();
        $endMonth = $this->now->copy()->endOfMonth()->toDateTimeString();

        return Ticket::query()
            ->selectRaw('
                strftime(\'%Y-%m\', opened_at) as month,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as open_count,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as in_progress_count,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as closed_count,
                SUM(CASE WHEN status_id = ? AND closed_at IS NOT NULL AND cost IS NOT NULL THEN cost ELSE 0 END) as total_cost
            ', [$this->openStatusId, $this->inProgressStatusId, $this->closedStatusId, $this->closedStatusId])
            ->whereNull('tickets.deleted_at')
            ->whereNotNull('opened_at')
            ->whereBetween('opened_at', [$startMonth, $endMonth])
            ->groupByRaw('strftime(\'%Y-%m\', opened_at)')
            ->get();
    }

    private function formatResults(array $monthKeys, $rows): array
    {
        $open = $inProgress = $closed = $costData = [];

        foreach ($monthKeys as $key) {
            $row = $rows->get($key);
            $open[] = (int) ($row->open_count ?? 0);
            $inProgress[] = (int) ($row->in_progress_count ?? 0);
            $closed[] = (int) ($row->closed_count ?? 0);
            $costData[] = round((float) ($row->total_cost ?? 0), 2);
        }

        return [
            'labels' => $monthKeys,
            'open' => $open,
            'in_progress' => $inProgress,
            'closed' => $closed,
            'cost_data' => $costData,
        ];
    }
}
