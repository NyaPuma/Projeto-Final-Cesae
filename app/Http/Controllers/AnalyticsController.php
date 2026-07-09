<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use OpenApi\Attributes as OA;

class AnalyticsController extends Controller
{
    /**
     * Obtém métricas gerais de tickets fechados e tempos médios.
     * Otimizado para executar agregações diretamente na base de dados.
     */
    #[OA\Get(
        path: '/analytics/stats',
        tags: ['Analytics'],
        summary: 'Métricas gerais',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'KPIs agregados')
        ]
    )]
    public function stats(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // Apenas técnicos e administradores podem consultar métricas operacionais.
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);
        
        $openStatusId   = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        
        $closedTickets = Ticket::where('status_id', $closedStatusId)
            ->whereNotNull('opened_at')
            ->whereNotNull('closed_at')
            ->get(['opened_at', 'closed_at']);

        $openTickets = Ticket::where('status_id', $openStatusId)
            ->whereNotNull('opened_at')
            ->get(['opened_at']);

        $averageResolution = $closedTickets->avg(function ($ticket) {
            return Carbon::parse($ticket->opened_at)->diffInMinutes(Carbon::parse($ticket->closed_at));
        });

        $averageWaiting = $openTickets->avg(function ($ticket) {
            return Carbon::parse($ticket->opened_at)->diffInMinutes(now());
        });

        $openTicketsCount   = Ticket::where('status_id', $openStatusId)->count();
        $closedTicketsCount = Ticket::where('status_id', $closedStatusId)->count();

        return response()->json([
            'average_resolution_minutes' => round($averageResolution ?: 0, 2),
            'average_waiting_minutes'    => round($averageWaiting ?: 0, 2),
            'open_tickets'               => $openTicketsCount,
            'closed_tickets'             => $closedTicketsCount,
        ]);
    }

    /**
     * Fornece dados JSON formatados para gráficos Chart.js no dashboard.
     * Inclui: distribuição por prioridade, tickets por mês (últimos 6 meses),
     * custo mensal acumulado e top 5 equipamentos com mais tickets.
     */
    #[OA\Get(
        path: '/analytics/charts',
        tags: ['Analytics'],
        summary: 'Dados para dashboards',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Séries para gráficos')
        ]
    )]
    public function charts(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // Os gráficos seguem a mesma política de acesso das métricas.
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        // Distribuição por prioridade
        // Agregamos por prioridade diretamente na base para evitar processamento desnecessário em PHP.
        $byPriority = DB::table('tickets')
            ->select('priority', DB::raw('COUNT(*) as total'))
            ->groupBy('priority')
            ->get()
            ->mapWithKeys(fn($row) => [$row->priority => $row->total]);

        $openStatusId   = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);

        // Limita o conjunto aos últimos seis meses para os gráficos ficarem rápidos e relevantes.
        $recentTickets = Ticket::with('equipment')
            ->whereNotNull('opened_at')
            ->where('opened_at', '>=', now()->subMonths(6))
            ->get(['opened_at', 'closed_at', 'status_id', 'cost', 'equipment_id']);

        $months        = [];
        $openByMonth   = [];
        $closedByMonth = [];
        $monthlyCost   = [];

        foreach ($recentTickets as $ticket) {
            $month = Carbon::parse($ticket->opened_at)->format('Y-m');
            $months[$month] = true;
            $openByMonth[$month] = $openByMonth[$month] ?? 0;
            $closedByMonth[$month] = $closedByMonth[$month] ?? 0;

            if ($ticket->status_id == $openStatusId) {
                $openByMonth[$month]++;
            }

            if ($ticket->status_id == $closedStatusId) {
                $closedByMonth[$month]++;
            }

            if ($ticket->status_id == $closedStatusId && $ticket->closed_at && $ticket->cost !== null) {
                $closedMonth = Carbon::parse($ticket->closed_at)->format('Y-m');
                $monthlyCost[$closedMonth] = ($monthlyCost[$closedMonth] ?? 0) + (float) $ticket->cost;
            }
        }

        ksort($months);
        ksort($openByMonth);
        ksort($closedByMonth);
        ksort($monthlyCost);

        $topEquipments = $recentTickets
            ->whereNotNull('equipment_id')
            ->groupBy('equipment_id')
            ->map(function ($tickets) {
                return [
                    'name' => optional($tickets->first()->equipment)->name ?? 'N/A',
                    'total' => $tickets->count(),
                ];
            })
            ->sortByDesc('total')
            ->take(5)
            ->values();

        return response()->json([
            'by_priority' => [
                'labels' => $byPriority->keys()->values(),
                'data'   => $byPriority->values()->values(),
            ],
            'monthly_tickets' => [
                'labels' => array_keys($months),
                'open'   => array_values($openByMonth),
                'closed' => array_values($closedByMonth),
            ],
            'monthly_cost' => [
                'labels' => array_keys($monthlyCost),
                'data'   => array_values($monthlyCost),
            ],
            'top_equipment' => [
                'labels' => $topEquipments->pluck('name')->values(),
                'data'   => $topEquipments->pluck('total')->values(),
            ],
        ]);
    }

    /**
     * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
     * Otimizado para mitigar problemas de "Memory Limit Exceeded".
     */
    public function exportCsv(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // Exportar CSV é uma operação de backoffice, não para perfis básicos.
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);
        
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tickets_report.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['id','title','status_id','opened_at','in_progress_at','closed_at','minutes_spent','cost','budget_status','budget_amount']);

            // O método cursor() utiliza PHP Generators – mantém apenas 1 registo em memória de cada vez.
            foreach (Ticket::cursor() as $t) {
                fputcsv($handle, [
                    $t->id,
                    $t->title,
                    $t->status_id,
                    optional($t->opened_at)->toDateTimeString(),
                    optional($t->in_progress_at)->toDateTimeString(),
                    optional($t->closed_at)->toDateTimeString(),
                    $t->minutes_spent,
                    $t->cost,
                    $t->budget_status,
                    $t->budget_amount,
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
            new OA\Response(response: 200, description: 'Ficheiro PDF descarregado')
        ]
    )]
    public function exportPdf(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // O PDF reaproveita a mesma regra de acesso do restante módulo analítico.
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);
        
        $tickets = Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount'
        ])->get();

        $pdf = PDF::loadView('reports.tickets', ['tickets' => $tickets]);

        return $pdf->download('tickets_report.pdf');
    }

    /**
     * Exporta o relatório de tickets em formato Excel (.xlsx) usando Maatwebsite/Excel.
     * Inclui estilos de cabeçalho, auto-sizing das colunas e formatação de moeda.
     */
    #[OA\Get(
        path: '/analytics/export/excel',
        tags: ['Analytics'],
        summary: 'Exportar Excel',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro XLSX descarregado')
        ]
    )]
    public function exportExcel(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // A exportação Excel segue a mesma política de permissões das restantes exportações.
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $filename = 'tickets_report_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new TicketsExport(), $filename);
    }
}
