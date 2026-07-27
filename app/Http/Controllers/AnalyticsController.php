<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Models\Audit;
use App\Models\Ticket;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnalyticsController extends Controller
{
    /**
     * Obtém o payload completo do dashboard analítico para a interface web.
     */
    #[OA\Get(
        path: '/analytics/stats',
        tags: ['Analytics'],
        summary: 'Métricas gerais',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'KPIs agregados'),
        ]
    )]
    public function stats(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        return response()->json($this->buildPayload());
    }

    /**
     * Fornece os dados para os gráficos do dashboard analítico.
     */
    #[OA\Get(
        path: '/analytics/charts',
        tags: ['Analytics'],
        summary: 'Dados para dashboards',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Séries para gráficos'),
        ]
    )]
    public function charts(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        return response()->json($this->buildPayload());
    }

    private function buildPayload(): array
    {
        $cacheKey = 'analytics_dashboard_payload';

        return Cache::remember($cacheKey, 60, function () {
            $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
            $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
            $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
            $slaTargetMinutes = 480;

            $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

            // Query única: counts + avg resolution + avg waiting + SLA count
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
                    $openStatusId,
                    $inProgressStatusId,
                    Ticket::BUDGET_PENDING,
                    $closedStatusId,
                    $closedStatusId,
                    $inProgressStatusId,
                    $closedStatusId,
                    $slaTargetMinutes,
                ])
                ->first();

            $openTickets = (int) ($kpiRow->open_tickets ?? 0);
            $inProgressTickets = (int) ($kpiRow->in_progress_tickets ?? 0);
            $budgetPendingTickets = (int) ($kpiRow->budget_pending_tickets ?? 0);
            $closedTickets = (int) ($kpiRow->closed_tickets ?? 0);
            $avgResolution = (float) ($kpiRow->avg_resolution ?? 0);
            $avgWaiting = (float) ($kpiRow->avg_waiting ?? 0);
            $slaMet = (int) ($kpiRow->sla_met ?? 0);
            $slaSuccess = $closedTickets > 0 ? round(($slaMet / $closedTickets) * 100, 1) : 100;

            $statusBreakdown = collect([
                ['label' => 'Abertos', 'value' => $openTickets],
                ['label' => 'Em Curso', 'value' => $inProgressTickets],
                ['label' => 'Pendente de Orçamento', 'value' => $budgetPendingTickets],
                ['label' => 'Fechados', 'value' => $closedTickets],
            ]);

            // Priority breakdown via query única
            $priorityRow = (clone $baseQuery)
                ->selectRaw('
                    SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as low,
                    SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as medium,
                    SUM(CASE WHEN priority = ? THEN 1 ELSE 0 END) as high
                ', [Ticket::PRIORITY_LOW, Ticket::PRIORITY_MEDIUM, Ticket::PRIORITY_HIGH])
                ->first();

            $priorityBreakdown = collect([
                ['label' => 'Baixa', 'value' => (int) ($priorityRow->low ?? 0)],
                ['label' => 'Média', 'value' => (int) ($priorityRow->medium ?? 0)],
                ['label' => 'Alta', 'value' => (int) ($priorityRow->high ?? 0)],
            ]);

            // Monthly series via query única com agregação condicional
            $monthlyBuckets = $this->buildMonthlySeriesFromDb($openStatusId, $inProgressStatusId, $closedStatusId);

            // Top equipamentos via agregação SQL
            $topEquipments = (clone $baseQuery)
                ->join('equipments', 'tickets.equipment_id', '=', 'equipments.id')
                ->select('equipments.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.equipment_id')
                ->groupBy('equipments.name')
                ->orderByDesc('total')
                ->limit(5)
                ->pluck('total', 'name')
                ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'intervenções'])
                ->values();

            // Top salas via agregação SQL
            $topRooms = (clone $baseQuery)
                ->join('rooms', 'tickets.room_id', '=', 'rooms.id')
                ->select('rooms.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.room_id')
                ->groupBy('rooms.name')
                ->orderByDesc('total')
                ->limit(5)
                ->pluck('total', 'name')
                ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'tickets'])
                ->values();

            // Top técnicos via agregação SQL
            $topTechnicians = (clone $baseQuery)
                ->join('users', 'tickets.assigned_to', '=', 'users.id')
                ->select('users.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.assigned_to')
                ->groupBy('users.name')
                ->orderByDesc('total')
                ->limit(5)
                ->pluck('total', 'name')
                ->map(fn (int|string $total, string $name) => ['name' => $name, 'total' => (int) $total, 'subtitle' => 'ações'])
                ->values();

            $recentActivity = Audit::query()
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
                    'labels' => $priorityBreakdown->pluck('label')->values(),
                    'data' => $priorityBreakdown->pluck('value')->values(),
                ],
                'ticket_status_breakdown' => [
                    'labels' => $statusBreakdown->pluck('label')->values(),
                    'data' => $statusBreakdown->pluck('value')->values(),
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
                'top_equipments' => $topEquipments,
                'top_equipment' => $topEquipments,
                'top_rooms' => $topRooms,
                'top_technicians' => $topTechnicians,
                'recent_activity' => $recentActivity,
            ];
        });
    }

    private function buildMonthlySeriesFromDb(int $openStatusId, int $inProgressStatusId, ?int $closedStatusId): array
    {
        $now = now();

        $monthKeys = [];
        foreach (range(5, 0) as $offset) {
            $monthKeys[] = $now->copy()->subMonths($offset)->format('Y-m');
        }

        $startMonth = $now->copy()->subMonths(5)->startOfMonth()->toDateTimeString();
        $endMonth = $now->copy()->endOfMonth()->toDateTimeString();

        // Query única com agregação condicional por mês
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

        $open = [];
        $inProgress = [];
        $closed = [];
        $costLabels = [];
        $costData = [];

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

    /**
     * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
     */
    #[OA\Get(
        path: '/analytics/export/csv',
        tags: ['Analytics'],
        summary: 'Exportar CSV',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro CSV descarregado'),
        ]
    )]
    public function exportCsv(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tickets_report.csv"',
        ];

        $callback = function () {
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
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Exporta o relatório de tickets em formato PDF via DOMPDF.
     */
    #[OA\Get(
        path: '/analytics/export/pdf',
        tags: ['Analytics'],
        summary: 'Exportar PDF',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro PDF descarregado'),
        ]
    )]
    public function exportPdf(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $tickets = Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])->get();

        $pdf = PDF::loadView('reports.tickets', ['tickets' => $tickets]);

        return $pdf->download('tickets_report.pdf');
    }

    /**
     * Exporta o relatório de tickets em formato Excel (.xlsx).
     */
    #[OA\Get(
        path: '/analytics/export/excel',
        tags: ['Analytics'],
        summary: 'Exportar Excel',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro XLSX descarregado'),
        ]
    )]
    public function exportExcel(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $filename = 'tickets_report_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new TicketsExport, $filename);
    }
}
