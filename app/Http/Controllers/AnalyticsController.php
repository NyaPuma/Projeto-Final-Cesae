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

            // Agregação a nível de BD em vez de carregar todos os tickets para memória
            $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

            $openTickets = (clone $baseQuery)->where('status_id', $openStatusId)->count();
            $inProgressTickets = (clone $baseQuery)->where('status_id', $inProgressStatusId)->count();
            $budgetPendingTickets = (clone $baseQuery)->where('budget_status', Ticket::BUDGET_PENDING)->count();
            $closedTickets = (clone $baseQuery)
                ->where('status_id', $closedStatusId)
                ->whereNotNull('opened_at')
                ->whereNotNull('closed_at')
                ->count();

            // Média de resolução via SQL
            $avgResolution = (clone $baseQuery)
                ->where('status_id', $closedStatusId)
                ->whereNotNull('opened_at')
                ->whereNotNull('closed_at')
                ->selectRaw('AVG(CAST((julianday(closed_at) - julianday(opened_at)) * 1440 AS INTEGER)) as avg_minutes')
                ->value('avg_minutes') ?? 0;

            // Média de espera (tickets não fechados)
            $avgWaiting = (clone $baseQuery)
                ->where('status_id', '!=', $closedStatusId)
                ->whereNotNull('opened_at')
                ->selectRaw('AVG(CAST((julianday(datetime(\'now\')) - julianday(opened_at)) * 1440 AS INTEGER)) as avg_minutes')
                ->value('avg_minutes') ?? 0;

            // SLA success rate
            $slaSuccess = $closedTickets > 0
                ? round(
                    ((clone $baseQuery)
                        ->where('status_id', $closedStatusId)
                        ->whereNotNull('opened_at')
                        ->whereNotNull('closed_at')
                        ->whereRaw('(julianday(closed_at) - julianday(opened_at)) * 1440 <= ?', [$slaTargetMinutes])
                        ->count() / $closedTickets) * 100,
                    1
                )
                : 100;

            $statusBreakdown = collect([
                ['label' => 'Abertos', 'value' => $openTickets],
                ['label' => 'Em Curso', 'value' => $inProgressTickets],
                ['label' => 'Pendente de Orçamento', 'value' => $budgetPendingTickets],
                ['label' => 'Fechados', 'value' => $closedTickets],
            ]);

            // Priority breakdown via BD
            $priorityBreakdown = collect([
                ['label' => 'Baixa', 'value' => (clone $baseQuery)->where('priority', Ticket::PRIORITY_LOW)->count()],
                ['label' => 'Média', 'value' => (clone $baseQuery)->where('priority', Ticket::PRIORITY_MEDIUM)->count()],
                ['label' => 'Alta', 'value' => (clone $baseQuery)->where('priority', Ticket::PRIORITY_HIGH)->count()],
            ]);

            // Monthly series via chunking para não memória
            $monthlyBuckets = $this->buildMonthlySeriesFromDb($openStatusId, $inProgressStatusId, $closedStatusId);

            // Top equipamentos via agregação SQL
            $topEquipments = (clone $baseQuery)
                ->join('equipments', 'tickets.equipment_id', '=', 'equipments.id')
                ->select('equipments.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.equipment_id')
                ->groupBy('equipments.name')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
                ->map(fn ($row) => ['name' => $row->name, 'total' => $row->total, 'subtitle' => 'intervenções'])
                ->values();

            // Top salas via agregação SQL
            $topRooms = (clone $baseQuery)
                ->join('rooms', 'tickets.room_id', '=', 'rooms.id')
                ->select('rooms.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.room_id')
                ->groupBy('rooms.name')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
                ->map(fn ($row) => ['name' => $row->name, 'total' => $row->total, 'subtitle' => 'tickets'])
                ->values();

            // Top técnicos via agregação SQL
            $topTechnicians = (clone $baseQuery)
                ->join('users', 'tickets.assigned_to', '=', 'users.id')
                ->select('users.name', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tickets.assigned_to')
                ->groupBy('users.name')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
                ->map(fn ($row) => ['name' => $row->name, 'total' => $row->total, 'subtitle' => 'ações'])
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
                        'deleted' => 'Removou um registo do sistema.',
                        default => 'Ação registada na auditoria.',
                    };

                    return [
                        'title' => $userName,
                        'description' => $description,
                        'time' => $audit->created_at?->diffForHumans() ?? 'recentemente',
                    ];
                })
                ->values();

            $payload = [
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

            return $payload;
        });
    }

    private function buildMonthlySeriesFromDb(int $openStatusId, int $inProgressStatusId, ?int $closedStatusId): array
    {
        $months = [];
        $open = [];
        $inProgress = [];
        $closed = [];
        $costLabels = [];
        $costData = [];

        $now = now();

        foreach (range(5, 0) as $offset) {
            $monthKey = $now->subMonths($offset)->format('Y-m');
            $months[] = $monthKey;
            $open[$monthKey] = 0;
            $inProgress[$monthKey] = 0;
            $closed[$monthKey] = 0;
            $costLabels[$monthKey] = 0;
        }

        $startMonth = $now->copy()->subMonths(5)->startOfMonth()->toDateTimeString();
        $endMonth = $now->copy()->endOfMonth()->toDateTimeString();

        // Agregação via chunking para não carregar tudo em memória
        Ticket::query()
            ->select('status_id', 'opened_at', 'closed_at', 'cost')
            ->whereNull('tickets.deleted_at')
            ->whereNotNull('opened_at')
            ->whereBetween('opened_at', [$startMonth, $endMonth])
            ->chunk(500, function ($tickets) use (&$open, &$inProgress, &$closed, &$costData, &$costLabels, $openStatusId, $inProgressStatusId, $closedStatusId) {
                foreach ($tickets as $ticket) {
                    $monthKey = \Carbon\Carbon::parse($ticket->opened_at)->format('Y-m');
                    if (! array_key_exists($monthKey, $open)) {
                        continue;
                    }

                    if ($ticket->status_id === $openStatusId) {
                        $open[$monthKey]++;
                    }
                    if ($ticket->status_id === $inProgressStatusId) {
                        $inProgress[$monthKey]++;
                    }
                    if ($ticket->status_id === $closedStatusId) {
                        $closed[$monthKey]++;
                        if ($ticket->closed_at && $ticket->cost !== null) {
                            $costData[$monthKey] = ($costData[$monthKey] ?? 0) + (float) $ticket->cost;
                        }
                    }
                }
            });

        return [
            'labels' => array_keys($open),
            'open' => array_values($open),
            'in_progress' => array_values($inProgress),
            'closed' => array_values($closed),
            'cost_labels' => array_keys($costLabels),
            'cost_data' => array_values($costData),
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

            foreach (Ticket::cursor() as $ticket) {
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
