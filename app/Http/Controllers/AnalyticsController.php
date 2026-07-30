<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Models\Audit;
use App\Models\Ticket;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
        return response()->json($this->buildPayload());
    }

    /**
     * Helper privado para converter minutos brutos em formato humano legível (ex: "6d 16h").
     */
    private function formatMinutesToHuman(float $minutes): string
    {
        if ($minutes <= 0) {
            return '0h 0m';
        }

        $days = floor($minutes / 1440);
        $hours = floor(($minutes % 1440) / 60);
        $remainingMinutes = round($minutes % 60);

        if ($days > 0) {
            return "{$days}d {$hours}h";
        }

        if ($hours > 0) {
            return "{$hours}h {$remainingMinutes}m";
        }

        return "{$remainingMinutes}m";
    }

    private function buildPayload(): array
    {
        // Resguardo defensivo para identificação de estados
        $openStatusId = method_exists(Ticket::class, 'getStatusIdByName') && defined('App\Models\Ticket::STATUS_OPEN')
            ? Ticket::getStatusIdByName(Ticket::STATUS_OPEN) : 1;

        $inProgressStatusId = method_exists(Ticket::class, 'getStatusIdByName') && defined('App\Models\Ticket::STATUS_IN_PROGRESS')
            ? Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS) : 2;

        $closedStatusId = method_exists(Ticket::class, 'getStatusIdByName') && defined('App\Models\Ticket::STATUS_CLOSED')
            ? Ticket::getStatusIdByName(Ticket::STATUS_CLOSED) : 3;

        // Leitura de tickets com carregamento seguro de relações
        $relations = ['equipment', 'room'];
        if (method_exists(Ticket::class, 'technician')) {
            $relations[] = 'technician';
        }

        $tickets = Ticket::query()->with($relations)->get();

        $openTickets = $tickets->filter(fn ($t) => (int)$t->status_id === (int)$openStatusId);
        $inProgressTickets = $tickets->filter(fn ($t) => (int)$t->status_id === (int)$inProgressStatusId);
        $closedTickets = $tickets->filter(fn ($t) => (int)$t->status_id === (int)$closedStatusId && $t->opened_at && $t->closed_at);
        $budgetPendingTickets = $tickets->filter(fn ($t) => strtolower($t->budget_status ?? '') === 'pending');

        $averageResolutionMinutes = $closedTickets->map(function ($ticket) {
            return Carbon::parse($ticket->opened_at)->diffInMinutes(Carbon::parse($ticket->closed_at));
        })->avg() ?: 0;

        $averageWaitingMinutes = $tickets->filter(fn ($ticket) => $ticket->opened_at && (int)$ticket->status_id !== (int)$closedStatusId)
            ->map(function ($ticket) {
                return Carbon::parse($ticket->opened_at)->diffInMinutes(now());
            })->avg() ?: 0;

        $slaSuccess = $closedTickets->count() > 0
            ? round(
                ($closedTickets->filter(function ($ticket) {
                    $duration = Carbon::parse($ticket->opened_at)->diffInMinutes(Carbon::parse($ticket->closed_at));
                    return $duration <= 480;
                })->count() / $closedTickets->count()) * 100,
                1
            )
            : 100;

        $statusBreakdown = collect([
            ['label' => 'Abertos', 'value' => $openTickets->count()],
            ['label' => 'Em Curso', 'value' => $inProgressTickets->count()],
            ['label' => 'Pendente de Orçamento', 'value' => $budgetPendingTickets->count()],
            ['label' => 'Fechados', 'value' => $closedTickets->count()],
        ]);

        $priorityBreakdown = collect([
            ['label' => 'Baixa', 'value' => $tickets->filter(fn ($t) => strtolower($t->priority ?? '') === 'low' || $t->priority == '1')->count()],
            ['label' => 'Média', 'value' => $tickets->filter(fn ($t) => strtolower($t->priority ?? '') === 'medium' || $t->priority == '2')->count()],
            ['label' => 'Alta', 'value' => $tickets->filter(fn ($t) => strtolower($t->priority ?? '') === 'high' || $t->priority == '3')->count()],
        ]);

        $monthlyBuckets = $this->buildMonthlySeries($tickets, $openStatusId, $inProgressStatusId, $closedStatusId);

        $topEquipments = $tickets->filter(fn ($t) => $t->equipment !== null)
            ->groupBy('equipment_id')
            ->map(fn ($group) => [
                'name' => optional($group->first()->equipment)->name ?? 'Equipamento #' . $group->first()->equipment_id,
                'total' => $group->count(),
                'subtitle' => 'intervenções',
            ])
            ->sortByDesc('total')
            ->take(5)
            ->values();

        $topRooms = $tickets->filter(fn ($t) => $t->room !== null)
            ->groupBy('room_id')
            ->map(fn ($group) => [
                'name' => optional($group->first()->room)->name ?? 'Sala #' . $group->first()->room_id,
                'total' => $group->count(),
                'subtitle' => 'tickets',
            ])
            ->sortByDesc('total')
            ->take(5)
            ->values();

        $topTechnicians = $tickets->filter(fn ($t) => !empty($t->assigned_to))
            ->groupBy('assigned_to')
            ->map(function ($group) {
                $tech = optional($group->first())->technician;
                $name = $tech ? $tech->name : (User::find($group->first()->assigned_to)?->name ?? 'Técnico #' . $group->first()->assigned_to);
                return [
                    'name' => $name,
                    'total' => $group->count(),
                    'subtitle' => 'ações',
                ];
            })
            ->sortByDesc('total')
            ->take(5)
            ->values();

        $recentActivity = [];
        try {
            if (class_exists('App\Models\Audit')) {
                $recentActivity = Audit::query()
                    ->with('user')
                    ->latest()
                    ->take(6)
                    ->get()
                    ->map(function ($audit) {
                        $userName = optional($audit->user)->name ?? 'Sistema';
                        $description = match ($audit->event ?? '') {
                            'created' => 'Registou uma nova entrada no sistema.',
                            'updated' => 'Atualizou campos de um registo.',
                            'deleted' => 'Removeu um registo do sistema.',
                            default => 'Ação registada na auditoria.',
                        };

                        return [
                            'title' => $userName,
                            'description' => $description,
                            'time' => $audit->created_at?->diffForHumans() ?? 'recentemente',
                        ];
                    })
                    ->values()
                    ->toArray();
            }
        } catch (\Throwable $e) {
            $recentActivity = [];
        }

        return [
            'average_resolution_minutes' => round($averageResolutionMinutes, 1),
            'average_resolution_human' => $this->formatMinutesToHuman($averageResolutionMinutes),
            'average_waiting_minutes' => round($averageWaitingMinutes, 1),
            'average_waiting_human' => $this->formatMinutesToHuman($averageWaitingMinutes),
            'open_tickets' => $openTickets->count(),
            'in_progress_tickets' => $inProgressTickets->count(),
            'waiting_budget_tickets' => $budgetPendingTickets->count(),
            'closed_tickets' => $closedTickets->count(),
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
    }

    private function buildMonthlySeries(Collection $tickets, int $openStatusId, int $inProgressStatusId, int $closedStatusId): array
    {
        $open = [];
        $inProgress = [];
        $closed = [];
        $costLabels = [];

        foreach (range(5, 0) as $offset) {
            $monthKey = now()->subMonths($offset)->format('Y-m');
            $open[$monthKey] = 0;
            $inProgress[$monthKey] = 0;
            $closed[$monthKey] = 0;
            $costLabels[$monthKey] = 0;
        }

        foreach ($tickets as $ticket) {
            if (!$ticket->opened_at) {
                continue;
            }

            $monthKey = Carbon::parse($ticket->opened_at)->format('Y-m');
            if (!array_key_exists($monthKey, $open)) {
                continue;
            }

            if ((int)$ticket->status_id === (int)$openStatusId) {
                $open[$monthKey]++;
            }

            if ((int)$ticket->status_id === (int)$inProgressStatusId) {
                $inProgress[$monthKey]++;
            }

            if ((int)$ticket->status_id === (int)$closedStatusId) {
                $closed[$monthKey]++;

                if ($ticket->closed_at && isset($ticket->cost)) {
                    $costLabels[$monthKey] += (float)$ticket->cost;
                }
            }
        }

        return [
            'labels' => array_keys($open),
            'open' => array_values($open),
            'in_progress' => array_values($inProgress),
            'closed' => array_values($closed),
            'cost_labels' => array_keys($costLabels),
            'cost_data' => array_values($costLabels),
        ];
    }

    /**
     * Exporta o relatório de todos os tickets em formato CSV.
     */
    public function exportCsv(Request $request)
    {
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
    public function exportPdf(Request $request)
    {
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
    public function exportExcel(Request $request)
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new TicketsExport, $filename);
    }
}