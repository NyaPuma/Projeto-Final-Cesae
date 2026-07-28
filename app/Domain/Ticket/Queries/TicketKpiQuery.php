<?php

namespace App\Domain\Ticket\Queries;

use App\Enums\BudgetStatusEnum;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;

final readonly class TicketKpiQuery
{
    public function __construct(
        private int $openStatusId,
        private int $inProgressStatusId,
        private int $closedStatusId,
        private int $slaTargetMinutes = 480,
    ) {}

    public function execute(): array
    {
        $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

        $kpiRow = $this->buildKpiQuery($baseQuery)->first();

        return [
            'open_tickets' => (int) ($kpiRow->open_tickets ?? 0),
            'in_progress_tickets' => (int) ($kpiRow->in_progress_tickets ?? 0),
            'budget_pending_tickets' => (int) ($kpiRow->budget_pending_tickets ?? 0),
            'closed_tickets' => (int) ($kpiRow->closed_tickets ?? 0),
            'avg_resolution' => (float) ($kpiRow->avg_resolution ?? 0),
            'avg_waiting' => (float) ($kpiRow->avg_waiting ?? 0),
            'sla_met' => (int) ($kpiRow->sla_met ?? 0),
        ];
    }

    private function buildKpiQuery(Builder $query): Builder
    {
        return $query->selectRaw('
            SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as open_tickets,
            SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as in_progress_tickets,
            SUM(CASE WHEN budget_status = ? THEN 1 ELSE 0 END) as budget_pending_tickets,
            SUM(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL THEN 1 ELSE 0 END) as closed_tickets,
            AVG(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL
                THEN CAST((julianday(closed_at) - julianday(opened_at)) * 1440 AS INTEGER) END) as avg_resolution,
            AVG(CASE WHEN status_id != ? AND opened_at IS NOT NULL
                THEN CAST((julianday(datetime(\'now\')) - julianday(opened_at)) * 1440 AS INTEGER) END) as avg_waiting,
            SUM(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL
                AND (julianday(closed_at) - julianday(opened_at)) * 1440 <= ? THEN 1 ELSE 0 END) as sla_met
        ', [
            $this->openStatusId,
            $this->inProgressStatusId,
            BudgetStatusEnum::Pending->value,
            $this->closedStatusId,
            $this->closedStatusId,
            $this->inProgressStatusId,
            $this->closedStatusId,
            $this->slaTargetMinutes,
        ]);
    }
}
