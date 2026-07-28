<?php

namespace App\Services;

use App\Domain\Ticket\Queries\MonthlyTicketsQuery;
use App\Domain\Ticket\Queries\TicketKpiQuery;
use App\Domain\Ticket\Queries\TicketPriorityQuery;
use App\Domain\Ticket\Queries\TopEntitiesQuery;
use App\Enums\TicketStatusEnum;
use App\Models\Audit;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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

        $baseQuery = Ticket::query()->whereNull('tickets.deleted_at');

        $kpiData = (new TicketKpiQuery($openStatusId, $inProgressStatusId, $closedStatusId))->execute();
        $priorityData = (new TicketPriorityQuery($baseQuery))->execute();
        $monthlyData = (new MonthlyTicketsQuery($openStatusId, $inProgressStatusId, $closedStatusId, now()))->execute();
        $topEntities = new TopEntitiesQuery($baseQuery);

        $slaSuccess = $kpiData['closed_tickets'] > 0
            ? round(($kpiData['sla_met'] / $kpiData['closed_tickets']) * 100, 1)
            : 100;

        return [
            'average_resolution_minutes' => round($kpiData['avg_resolution'], 1),
            'average_waiting_minutes' => round($kpiData['avg_waiting'], 1),
            'open_tickets' => $kpiData['open_tickets'],
            'in_progress_tickets' => $kpiData['in_progress_tickets'],
            'waiting_budget_tickets' => $kpiData['budget_pending_tickets'],
            'closed_tickets' => $kpiData['closed_tickets'],
            'system_availability' => config('services.custom.analytics.system_availability'),
            'sla_success' => $slaSuccess,
            'by_priority' => [
                'labels' => collect(['Baixa', 'Média', 'Alta']),
                'data' => collect([$priorityData['low'], $priorityData['medium'], $priorityData['high']]),
            ],
            'ticket_status_breakdown' => [
                'labels' => collect(['Abertos', 'Em Curso', 'Pendente de Orçamento', 'Fechados']),
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
            'top_equipments' => $topEntities->getTopEquipments(),
            'top_rooms' => $topEntities->getTopRooms(),
            'top_technicians' => $topEntities->getTopTechnicians(),
            'recent_activity' => $this->getRecentActivity(),
        ];
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
        $this->writeCsvRows($handle);
        fclose($handle);
    }

    public function exportCsvToFile(string $path): void
    {
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $handle = fopen($path, 'w');
        $this->writeCsvRows($handle);
        fclose($handle);
    }

    public function exportPdfToFile(string $path): void
    {
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $tickets = Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])->get();

        $pdf = Pdf::loadView('reports.tickets', ['tickets' => $tickets]);
        $pdf->save($path);
    }

    private function writeCsvRows($handle): void
    {
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
    }
}
