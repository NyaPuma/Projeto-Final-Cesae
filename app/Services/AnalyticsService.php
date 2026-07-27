<?php

namespace App\Services;

use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Audit;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class AnalyticsService
{
    public function __construct(
        private readonly TicketStatusService $statusService,
    ) {}

    public function getDashboardPayload(): array
    {
        return Cache::remember('analytics_dashboard_payload', 60, function () {
            return $this->buildPayload();
        });
    }

    private function buildPayload(): array
    {
        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);
        $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);
        $closedStatusId = $this->statusService->getByName(TicketStatusEnum::Closed);
        $slaTargetMinutes = config('services.analytics.sla_target_minutes', 480);

        $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

        $kpiRow = (clone $baseQuery)
            ->selectRaw('
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
                $openStatusId, $inProgressStatusId, BudgetStatusEnum::Pending->value, $closedStatusId,
                $closedStatusId, $inProgressStatusId, $closedStatusId, $slaTargetMinutes,
            ])->first();

        $openTickets = (int) ($kpiRow->open_tickets ?? 0);
        $inProgressTickets = (int) ($kpiRow->in_progress_tickets ?? 0);
        $budgetPendingTickets = (int) ($kpiRow->budget_pending_tickets ?? 0);
        $closedTickets = (int) ($kpiRow->closed_tickets ?? 0);
        $avgResolution = (float) ($kpiRow->avg_resolution ?? 0);
        $avgWaiting = (float) ($kpiRow->avg_waiting ?? 0);
        $slaMet = (int) ($kpiRow->sla_met ?? 0);
        $slaSuccess = $closedTickets > 0 ? round(($slaMet / $closedTickets) * 100, 1) : 100;

        $priorityRow = (clone $baseQuery)
            ->selectRaw('
                SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as low,
                SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as medium,
                SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as high
            ', [TicketPriorityEnum::Low->value, TicketPriorityEnum::Medium->value, TicketPriorityEnum::High->value])
            ->first();

        $monthlyBuckets = $this->buildMonthlySeries($openStatusId, $inProgressStatusId, $closedStatusId);

        return [
            'average_resolution_minutes' => round($avgResolution, 1),
            'average_waiting_minutes' => round($avgWaiting, 1),
            'open_tickets' => $openTickets,
            'in_progress_tickets' => $inProgressTickets,
            'waiting_budget_tickets' => $budgetPendingTickets,
            'closed_tickets' => $closedTickets,
            'system_availability' => 99.9,
            'sla_success' => $slaSuccess,
            'by_priority' => [
                'labels' => collect(['Baixa', 'Média', 'Alta']),
                'data' => collect([
                    (int) ($priorityRow->low ?? 0),
                    (int) ($priorityRow->medium ?? 0),
                    (int) ($priorityRow->high ?? 0),
                ]),
            ],
            'ticket_status_breakdown' => [
                'labels' => collect(['Abertos', 'Em Curso', 'Pendente de Orçamento', 'Fechados']),
                'data' => collect([$openTickets, $inProgressTickets, $budgetPendingTickets, $closedTickets]),
            ],
            'monthly_tickets' => [
                'labels' => $monthlyBuckets['labels'],
                'open' => $monthlyBuckets['open'],
                'in_progress' => $monthlyBuckets['in_progress'],
                'closed' => $monthlyBuckets['closed'],
            ],
            'monthly_cost' => [
                'labels' => $monthlyBuckets['cost_labels'],
                'data' => $monthlyBuckets['cost_data'],
            ],
            'top_equipments' => $this->getTopEquipments($baseQuery),
            'top_rooms' => $this->getTopRooms($baseQuery),
            'top_technicians' => $this->getTopTechnicians($baseQuery),
            'recent_activity' => $this->getRecentActivity(),
        ];
    }

    private function buildMonthlySeries(int $openStatusId, int $inProgressStatusId, ?int $closedStatusId): array
    {
        $now = now();
        $monthKeys = [];
        foreach (range(5, 0) as $offset) {
            $monthKeys[] = $now->copy()->subMonths($offset)->format('Y-m');
        }

        $startMonth = $now->copy()->subMonths(5)->startOfMonth()->toDateTimeString();
        $endMonth = $now->copy()->endOfMonth()->toDateTimeString();

        $rows = Ticket::query()
            ->selectRaw('
                strftime(\'%Y-%m\', opened_at) as month,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as open_count,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as in_progress_count,
                SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) as closed_count,
                SUM(CASE WHEN status_id = ? AND closed_at IS NOT NULL AND cost IS NOT NULL THEN cost ELSE 0 END) as total_cost
            ', [$openStatusId, $inProgressStatusId, $closedStatusId, $closedStatusId])
            ->whereNull('tickets.deleted_at')
            ->whereNotNull('opened_at')
            ->whereBetween('opened_at', [$startMonth, $endMonth])
            ->groupByRaw('strftime(\'%Y-%m\', opened_at)')
            ->get()
            ->keyBy('month');

        $open = $inProgress = $closed = $costLabels = $costData = [];

        foreach ($monthKeys as $key) {
            $row = $rows->get($key);
            $open[] = (int) ($row->open_count ?? 0);
            $inProgress[] = (int) ($row->in_progress_count ?? 0);
            $closed[] = (int) ($row->closed_count ?? 0);
            $costLabels[] = $key;
            $costData[] = round((float) ($row->total_cost ?? 0), 2);
        }

        return [
            'labels' => $monthKeys,
            'open' => $open,
            'in_progress' => $inProgress,
            'closed' => $closed,
            'cost_labels' => $costLabels,
            'cost_data' => $costData,
        ];
    }

    private function getTopEquipments($baseQuery): Collection
    {
        return (clone $baseQuery)
            ->join('equipments', 'tickets.equipment_id', '=', 'equipments.id')
            ->select('equipments.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.equipment_id')
            ->groupBy('equipments.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'intervenções'])
            ->values();
    }

    private function getTopRooms($baseQuery): Collection
    {
        return (clone $baseQuery)
            ->join('rooms', 'tickets.room_id', '=', 'rooms.id')
            ->select('rooms.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.room_id')
            ->groupBy('rooms.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'tickets'])
            ->values();
    }

    private function getTopTechnicians($baseQuery): Collection
    {
        return (clone $baseQuery)
            ->join('users', 'tickets.assigned_to', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tickets.assigned_to')
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'name')
            ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'ações'])
            ->values();
    }

    private function getRecentActivity(): Collection
    {
        return Audit::query()
            ->with('user')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($audit) {
                $userName = optional($audit->user)->name ?? 'Sistema';
                $description = match ($audit->event) {
                    'created' => 'Registou uma nova entrada no sistema.',
                    'updated' => 'Atualizou campos de um registo.',
                    'deleted' => 'Removiu um registo do sistema.',
                    default => 'Ação registada na auditoria.',
                };

                return [
                    'title' => $userName,
                    'description' => $description,
                    'time' => $audit->created_at?->diffForHumans() ?? 'recentemente',
                ];
            })
            ->values();
    }

    public function exportCsv(): void
    {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['id', 'title', 'status_id', 'opened_at', 'in_progress_at', 'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount']);

        Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])
            ->whereNull('tickets.deleted_at')
            ->chunk(500, function ($tickets) use ($handle) {
                foreach ($tickets as $ticket) {
                    fputcsv($handle, [
                        $ticket->id,
                        $ticket->title,
                        $ticket->status_id,
                        optional($ticket->opened_at)->toDateTimeString(),
                        optional($ticket->in_progress_at)->toDateTimeString(),
                        optional($ticket->closed_at)->toDateTimeString(),
                        $ticket->minutes_spent,
                        $ticket->cost,
                        $ticket->budget_status,
                        $ticket->budget_amount,
                    ]);
                }
            });

        fclose($handle);
    }
}
