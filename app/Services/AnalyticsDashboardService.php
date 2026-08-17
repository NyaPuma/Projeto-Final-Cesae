<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Ticket\Queries\MonthlyTicketsQuery;
use App\Domain\Ticket\Queries\TicketKpiQuery;
use App\Domain\Ticket\Queries\TicketPriorityQuery;
use App\Domain\Ticket\Queries\TopEntitiesQuery;
use App\Enums\BudgetStatusEnum;
use App\Enums\NotificationTypeEnum;
use App\Enums\StockMovementTypeEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Audit;
use App\Models\Notification;
use App\Models\Part;
use App\Models\StockMovement;
use App\Models\Ticket;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class AnalyticsDashboardService
{
    /**
     * @param TicketStatusService $statusService
     */
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    /**
     * Retorna o payload completo do painel analítico (com cache).
     *
     * @return array<string, mixed>
     */
    public function getDashboardPayload(): array
    {
        return Cache::remember(
            'analytics_dashboard_payload:' . app()->getLocale(),
            60,
            fn () => $this->buildPayload(),
        );
    }

    /**
     * Constrói o payload de dados para o painel analítico.
     *
     * @return array<string, mixed>
     */
    private function buildPayload(): array
    {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);
        $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);
        $closedStatusId = $this->statusService->getByName(TicketStatusEnum::Closed);

        $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

        $kpiData = (new TicketKpiQuery($openStatusId, $inProgressStatusId, $closedStatusId, config('services.analytics.sla_target_minutes', 480)))->execute();
        $priorityData = (new TicketPriorityQuery($baseQuery))->execute();
        $monthlyData = (new MonthlyTicketsQuery($openStatusId, $inProgressStatusId, $closedStatusId, now()))->execute();
        $topEntities = new TopEntitiesQuery($baseQuery);

        $slaSuccess = $kpiData['closed_tickets'] > 0
            ? round(($kpiData['sla_met'] / $kpiData['closed_tickets']) * 100, 1)
            : 100;

        $monthlyPerformance = $this->monthlyPerformanceData($monthlyData['labels']);

        return [
            'average_resolution_minutes' => round($kpiData['avg_resolution'], 1),
            'average_waiting_minutes' => round($kpiData['avg_waiting'], 1),
            'open_tickets' => $kpiData['open_tickets'],
            'in_progress_tickets' => $kpiData['in_progress_tickets'],
            'waiting_budget_tickets' => $kpiData['budget_pending_tickets'],
            'closed_tickets' => $kpiData['closed_tickets'],
            'system_availability' => config('services.analytics.system_availability', 99.9),
            'sla_success' => $slaSuccess,
            'by_priority' => [
                'labels' => collect([
                    TicketPriorityEnum::Low->label(),
                    TicketPriorityEnum::Medium->label(),
                    TicketPriorityEnum::High->label(),
                ]),
                'data' => collect([$priorityData['low'], $priorityData['medium'], $priorityData['high']]),
            ],
            'ticket_status_breakdown' => [
                'labels' => collect([
                    TicketStatusEnum::Open->label(),
                    TicketStatusEnum::InProgress->label(),
                    TicketStatusEnum::PendingBudget->label(),
                    TicketStatusEnum::Closed->label(),
                ]),
                'data' => collect([
                    $kpiData['open_tickets'],
                    $kpiData['in_progress_tickets'],
                    $kpiData['budget_pending_tickets'],
                    $kpiData['closed_tickets'],
                ]),
            ],
            'monthly_tickets' => [
                'labels' => $monthlyData['labels'],
                'open' => $monthlyData['open'],
                'in_progress' => $monthlyData['in_progress'],
                'closed' => $monthlyData['closed'],
            ],
            'monthly_cost' => [
                'labels' => $monthlyData['labels'],
                'data' => $monthlyData['cost_data'],
            ],
            'monthly_sla' => [
                'labels' => $monthlyData['labels'],
                'data' => $monthlyPerformance['sla'],
            ],
            'monthly_mttr' => [
                'labels' => $monthlyData['labels'],
                'data' => $monthlyPerformance['mttr'],
            ],
            'by_urgency' => $this->urgencyBreakdown($baseQuery),
            'by_room' => $this->roomBreakdown($baseQuery),
            'by_budget_status' => $this->budgetBreakdown($baseQuery),
            'by_source' => $this->sourceBreakdown($baseQuery),
            'cost_by_equipment' => $this->costByEquipment(),
            'stock_monthly' => $this->stockMonthlyData($monthlyData['labels']),
            'low_stock_parts' => $this->lowStockParts(),
            'notifications_by_type' => $this->notificationsByType(),
            'users_by_role' => $this->usersByRole(),
            'top_equipments' => $topEntities->getTopEquipments(),
            'top_rooms' => $topEntities->getTopRooms(),
            'top_technicians' => $topEntities->getTopTechnicians(),
            'recent_activity' => $this->getRecentActivity(),
        ];
    }

    /**
     * Desempenho mensal: taxa de SLA (percentagem) e MTTR (minutos) por mês.
     *
     * @param  array<int, string>  $monthLabels
     * @return array{sla: array<int, float|null>, mttr: array<int, float|null>}
     */
    private function monthlyPerformanceData(array $monthLabels): array
    {
        $start = \Illuminate\Support\Carbon::parse($monthLabels[0])->startOfMonth();
        $end = \Illuminate\Support\Carbon::parse(end($monthLabels))->endOfMonth();

        $driver = DB::connection()->getDriverName();
        $monthExpr = $driver === 'sqlite'
            ? "strftime('%Y-%m', opened_at)"
            : "DATE_FORMAT(opened_at, '%Y-%m')";
        $diffExpr = $driver === 'sqlite'
            ? "(julianday(closed_at) - julianday(opened_at)) * 1440"
            : "TIMESTAMPDIFF(MINUTE, opened_at, closed_at)";
        $targetMinutes = (int) config('services.analytics.sla_target_minutes', 480);

        $rows = Ticket::query()
            ->selectRaw("
                {$monthExpr} as month,
                AVG(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL
                    THEN {$diffExpr} END) as avg_resolution,
                SUM(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL
                    AND {$diffExpr} <= ? THEN 1 ELSE 0 END) as sla_met,
                SUM(CASE WHEN status_id = ? AND opened_at IS NOT NULL AND closed_at IS NOT NULL
                    THEN 1 ELSE 0 END) as closed_count
            ", [$this->statusService->getByName(TicketStatusEnum::Closed), $this->statusService->getByName(TicketStatusEnum::Closed), $targetMinutes, $this->statusService->getByName(TicketStatusEnum::Closed)])
            ->whereNull('tickets.deleted_at')
            ->whereNotNull('opened_at')
            ->whereBetween('opened_at', [$start, $end])
            ->groupByRaw($monthExpr)
            ->get()
            ->keyBy('month');

        $sla = [];
        $mttr = [];

        foreach ($monthLabels as $month) {
            $row = $rows->get($month);
            $closed = (int) ($row->closed_count ?? 0);
            $sla[] = $closed > 0 ? round((((int) ($row->sla_met ?? 0)) / $closed) * 100, 1) : null;
            $mttr[] = $row?->avg_resolution !== null ? round((float) $row->avg_resolution, 1) : null;
        }

        return [
            'sla' => $sla,
            'mttr' => $mttr,
        ];
    }

    /**
     * Distribuição dos tickets por urgência.
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function urgencyBreakdown(Builder $baseQuery): array
    {
        $urgent = (clone $baseQuery)->where('urgent', true)->count();
        $normal = (clone $baseQuery)->where(fn ($q) => $q->where('urgent', false)->orWhereNull('urgent'))->count();

        return [
            'labels' => collect([
                __('analytics_data.urgent'),
                __('analytics_data.normal'),
            ]),
            'data' => collect([$urgent, $normal]),
        ];
    }

    /**
     * Distribuição dos tickets por sala (top 8).
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function roomBreakdown(Builder $baseQuery): array
    {
        $rows = (clone $baseQuery)
            ->leftJoin('rooms', 'tickets.room_id', '=', 'rooms.id')
            ->select('rooms.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.room_id')
            ->groupBy('rooms.id', 'rooms.name')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return [
            'labels' => $rows->pluck('name'),
            'data' => $rows->pluck('total')->map(fn ($v) => (int) $v),
        ];
    }

    /**
     * Distribuição dos tickets por estado de orçamento.
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function budgetBreakdown(Builder $baseQuery): array
    {
        $rows = (clone $baseQuery)
            ->selectRaw('budget_status, COUNT(*) as total')
            ->whereNotNull('budget_status')
            ->groupBy('budget_status')
            ->get()
            ->pluck('total', 'budget_status');

        $labels = collect([BudgetStatusEnum::Pending, BudgetStatusEnum::Approved, BudgetStatusEnum::Rejected]);

        return [
            'labels' => $labels->map(fn ($s) => $s->label()),
            'data' => $labels->map(fn ($s) => (int) ($rows[$s->value] ?? 0)),
        ];
    }

    /**
     * Distribuição dos tickets por origem (web, qr, api, ...).
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function sourceBreakdown(Builder $baseQuery): array
    {
        $rows = (clone $baseQuery)
            ->selectRaw("COALESCE(NULLIF(source, ''), 'web') as source, COUNT(*) as total")
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        $labels = collect(['web', 'qr', 'api', 'mobile', 'telefone']);

        $sourceLabels = [
            'web' => __('analytics_data.web'),
            'qr' => __('analytics_data.qr'),
            'api' => __('analytics_data.api'),
            'mobile' => __('analytics_data.mobile'),
            'telefone' => __('analytics_data.phone'),
        ];

        return [
            'labels' => $labels->map(fn ($s) => $sourceLabels[$s] ?? $s),
            'data' => $labels->map(fn ($s) => (int) ($rows->firstWhere('source', $s)?->total ?? 0)),
        ];
    }

    /**
     * Custo total de intervenção por equipamento (top 8).
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, float>}
     */
    private function costByEquipment(): array
    {
        $rows = Ticket::query()
            ->leftJoin('equipments', 'tickets.equipment_id', '=', 'equipments.id')
            ->select('equipments.name', DB::raw('COALESCE(SUM(tickets.actual_cost), 0) as total'))
            ->whereNull('tickets.deleted_at')
            ->whereNotNull('tickets.equipment_id')
            ->whereNotNull('tickets.actual_cost')
            ->groupBy('equipments.id', 'equipments.name')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return [
            'labels' => $rows->pluck('name'),
            'data' => $rows->pluck('total')->map(fn ($v) => round((float) $v, 2)),
        ];
    }

    /**
     * Movimentação mensal de stock (entradas e saídas).
     *
     * @param  array<int, string>  $monthLabels
     * @return array{labels: array<int, string>, in: array<int, int>, out: array<int, int>}
     */
    private function stockMonthlyData(array $monthLabels): array
    {
        $start = \Illuminate\Support\Carbon::parse($monthLabels[0])->startOfMonth();
        $end = \Illuminate\Support\Carbon::parse(end($monthLabels))->endOfMonth();

        $driver = DB::connection()->getDriverName();
        $monthExpr = $driver === 'sqlite'
            ? "strftime('%Y-%m', created_at)"
            : "DATE_FORMAT(created_at, '%Y-%m')";

        $rows = StockMovement::query()
            ->selectRaw("
                {$monthExpr} as month,
                SUM(CASE WHEN movement_type IN (?, ?) THEN ABS(quantity) ELSE 0 END) as total_in,
                SUM(CASE WHEN movement_type = ? THEN ABS(quantity) ELSE 0 END) as total_out
            ", [StockMovementTypeEnum::In->value, StockMovementTypeEnum::Return->value, StockMovementTypeEnum::Out->value])
            ->whereBetween('created_at', [$start, $end])
            ->groupByRaw($monthExpr)
            ->get()
            ->keyBy('month');

        $in = [];
        $out = [];

        foreach ($monthLabels as $month) {
            $row = $rows->get($month);
            $in[] = (int) ($row->total_in ?? 0);
            $out[] = (int) ($row->total_out ?? 0);
        }

        return [
            'labels' => $monthLabels,
            'in' => $in,
            'out' => $out,
        ];
    }

    /**
     * Peças em alerta de stock baixo (top 8 por criticidade).
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function lowStockParts(): array
    {
        $parts = Part::query()
            ->lowStock()
            ->orderByRaw('CASE WHEN min_stock > 0 THEN current_stock * 1.0 / min_stock ELSE 0 END')
            ->orderBy('current_stock')
            ->limit(8)
            ->get(['name', 'current_stock']);

        return [
            'labels' => $parts->pluck('name'),
            'data' => $parts->pluck('current_stock')->map(fn ($v) => (int) $v),
        ];
    }

    /**
     * Notificações por tipo (top 8).
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function notificationsByType(): array
    {
        $rows = Notification::query()
            ->select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return [
            'labels' => $rows->pluck('type')->map(function ($type) {
                $value = (string) $type;

                return match ($value) {
                    'ticket_updated' => __('analytics_data.ticket_updated'),
                    'ticket_assigned' => __('analytics_data.ticket_assigned'),
                    'comment_added' => __('analytics_data.comment_added'),
                    'attachment_added' => __('analytics_data.attachment_added'),
                    'budget_request' => __('analytics_data.budget_request'),
                    default => NotificationTypeEnum::tryFrom($value)?->label() ?? ucfirst($value),
                };
            }),
            'data' => $rows->pluck('total')->map(fn ($v) => (int) $v),
        ];
    }

    /**
     * Distribuição de utilizadores por perfil.
     *
     * @return array{labels: Collection<int, string>, data: Collection<int, int>}
     */
    private function usersByRole(): array
    {
        $rows = UserProfile::query()
            ->leftJoin('users', 'users.profile_id', '=', 'user_profiles.id')
            ->whereNull('users.deleted_at')
            ->select('user_profiles.name', DB::raw('COUNT(users.id) as total'))
            ->groupBy('user_profiles.id', 'user_profiles.name')
            ->orderByDesc('total')
            ->get();

        return [
            'labels' => $rows->pluck('name')->map(fn ($name) => ucfirst((string) $name)),
            'data' => $rows->pluck('total')->map(fn ($v) => (int) $v),
        ];
    }

    /**
     * Obtém a atividade recente registada nas auditorias do sistema.
     *
     * @return Collection<int, array{title: string, description: string, time: string}>
     */
    private function getRecentActivity(): Collection
    {
        return Audit::query()
            ->with('user')
            ->latest()
            ->take(6)
            ->get()
            ->map(fn ($audit) => [
                'title' => optional($audit->user)->name ?? 'Sistema',
                'description' => $this->getAuditDescription($audit->event),
                'time' => $audit->created_at?->diffForHumans() ?? 'recentemente',
            ])
            ->values();
    }

    /**
     * Traduz o evento de auditoria numa descrição legível.
     */
    private function getAuditDescription(string $event): string
    {
        return match ($event) {
            'created' => 'Registou uma nova entrada no sistema.',
            'updated' => 'Atualizou campos de um registo.',
            'deleted' => 'Removeu um registo do sistema.',
            default => 'Ação registada na auditoria.',
        };
    }
}
