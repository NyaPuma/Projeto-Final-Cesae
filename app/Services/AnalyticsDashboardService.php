<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Ticket\Queries\MonthlyTicketsQuery;
use App\Domain\Ticket\Queries\TicketKpiQuery;
use App\Domain\Ticket\Queries\TicketPriorityQuery;
use App\Domain\Ticket\Queries\TopEntitiesQuery;
use App\Enums\TicketStatusEnum;
use App\Models\Audit;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember('analytics_dashboard_payload', 60, fn () => $this->buildPayload());
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
            'system_availability' => config('services.custom.analytics.system_availability', 99.9),
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
