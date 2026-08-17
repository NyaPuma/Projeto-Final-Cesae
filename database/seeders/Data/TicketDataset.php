<?php

declare(strict_types=1);

namespace Database\Seeders\Data;

use App\Enums\TicketPriorityEnum;
use Illuminate\Support\Carbon;

/**
 * Gera o conjunto de tickets sintéticos com regras de coerência fixas:
 * pareto por equipamento, SLA derivado de opened_at/closed_at, custos
 * coerentes com a mão-de-obra e distribuição mensal dos últimos 6 meses.
 */
final class TicketDataset
{
    public const TARGET_TICKETS = 1500;

    private const LABOUR_RATE_PER_HOUR = 35;

    /**
     * @param array<string, int> $statusIds
     * @param array<int, array{id: int, category: string, weight: int}> $equipmentRows
     * @param array<int, array{id: int, weight: int}> $rooms
     * @param array<int, int> $technicianIds
     * @param array<int, int> $reporterUserIds
     * @return array<int, array<string, mixed>>
     */
    public function generate(
        array $statusIds,
        array $equipmentRows,
        array $rooms,
        array $technicianIds,
        array $reporterUserIds,
    ): array {
        mt_srand(20260701);

        $scenarios = OperationalData::ticketScenariosByCategory();
        $equipmentWeights = array_column($equipmentRows, 'weight');
        $roomWeights = array_column($rooms, 'weight');

        $rows = [];

        for ($i = 1; $i <= self::TARGET_TICKETS; $i++) {
            $priority = $this->weightedPick([
                TicketPriorityEnum::Low->value,
                TicketPriorityEnum::Medium->value,
                TicketPriorityEnum::High->value,
                TicketPriorityEnum::Critical->value,
            ], [30, 40, 25, 5]);

            $status = $this->weightedPick([
                'aberta',
                'em curso',
                'fechada',
                'pendente orçamento',
                'cancelada',
                'recusada',
            ], [12, 18, 62, 5, 2, 1]);

            $source = $this->weightedPick(['web', 'qr', 'telefone', 'api', 'mobile'], [55, 25, 10, 7, 3]);

            $equipment = $equipmentRows[$this->weightedIndex($equipmentWeights)];
            $room = $rooms[$this->weightedIndex($roomWeights)]['id'];

            $scenarioPool = $scenarios[$equipment['category']] ?? $scenarios['Infraestruturas'];
            $scenario = $scenarioPool[random_int(0, count($scenarioPool) - 1)];

            $urgent = ($priority === TicketPriorityEnum::High->value && random_int(1, 100) <= 55)
                || ($priority === TicketPriorityEnum::Critical->value && random_int(1, 100) <= 80);

            $openedAt = $this->openedAtFor($status);
            $slaHours = $this->prioritySlaHours($priority);
            $dueAt = $openedAt->copy()->addHours($slaHours);

            $assigned = $status !== 'aberta';
            $assignedTo = $assigned && $technicianIds !== [] ? $technicianIds[random_int(0, count($technicianIds) - 1)] : null;
            $assignedAt = $assigned && $assignedTo !== null
                ? $openedAt->copy()->addMinutes(random_int(5, 180))
                : null;

            $firstResponseAt = $assignedAt !== null
                ? $assignedAt->copy()->addMinutes(random_int(2, 45))
                : null;

            $inProgressAt = in_array($status, ['em curso', 'fechada'], true) && $assignedAt !== null
                ? $assignedAt->copy()->addMinutes(random_int(5, 90))
                : null;

            $closedAt = null;
            $resolvedAt = null;
            $minutesSpent = null;
            $estimatedCost = null;
            $actualCost = null;
            $slaBreached = false;
            $resolutionSummary = null;
            $closedBy = null;

            if ($status === 'fechada') {
                $diffMinutes = $this->closedDiffMinutes();
                $closedAt = $openedAt->copy()->addMinutes($diffMinutes);
                $resolvedAt = $closedAt->copy()->subMinutes(random_int(5, 60));
                $slaBreached = $diffMinutes > 480;
                $minutesSpent = $diffMinutes + random_int(15, 60);

                $labour = ($minutesSpent / 60) * self::LABOUR_RATE_PER_HOUR;
                $parts = $this->partsCost();
                $actualCost = round($labour + $parts, 2);
                $estimatedCost = round($actualCost * random_int(65, 85) / 100, 2);
                $resolutionSummary = $scenario['title'];
                $closedBy = $assignedTo;
            }

            $budgetStatus = null;
            $budgetRequested = false;
            $budgetAmount = null;

            if ($status === 'pendente orçamento') {
                $budgetStatus = 'pending';
                $budgetRequested = true;
                $budgetAmount = round(($minutesSpent ?? random_int(120, 600)) / 60 * self::LABOUR_RATE_PER_HOUR * random_int(100, 140) / 100, 2);
            }

            $reporter = $source === 'web' ? ['user_id' => $reporterUserIds[random_int(0, max(0, count($reporterUserIds) - 1))] ?? null, 'name' => null, 'contact' => null]
                : ['user_id' => null, 'name' => $this->randomReporterName(), 'contact' => $this->randomPhone()];

            $rows[] = [
                'reference' => sprintf('TKT-2026-%05d', $i),
                'title' => mb_substr($scenario['title'], 0, 150),
                'description' => $scenario['description'],
                'priority' => $priority,
                'urgent' => $urgent,
                'source' => $source,
                'user_id' => $reporter['user_id'],
                'reporter_name' => $reporter['name'],
                'reporter_contact' => $reporter['contact'],
                'equipment_id' => $equipment['id'],
                'room_id' => $room,
                'assigned_to' => $assignedTo,
                'status_id' => $statusIds[$status],
                'opened_at' => $openedAt,
                'assigned_at' => $assignedAt,
                'first_response_at' => $firstResponseAt,
                'in_progress_at' => $inProgressAt,
                'resolved_at' => $resolvedAt,
                'closed_at' => $closedAt,
                'due_at' => $dueAt,
                'sla_breached' => $slaBreached,
                'minutes_spent' => $minutesSpent,
                'estimated_cost' => $estimatedCost,
                'actual_cost' => $actualCost,
                'resolution_summary' => $resolutionSummary,
                'closed_by' => $closedBy,
                'budget_requested' => $budgetRequested,
                'budget_status' => $budgetStatus,
                'budget_amount' => $budgetAmount,
                'scheduled' => false,
                'created_at' => $openedAt,
                'updated_at' => Carbon::now(),
            ];
        }

        return $rows;
    }

    private function openedAtFor(string $status): Carbon
    {
        if ($status === 'fechada') {
            $monthWeights = [10, 12, 14, 17, 20, 27];
            $monthOffset = $this->weightedIndex($monthWeights);
            $start = Carbon::now()->startOfMonth()->subMonths($monthOffset);

            return $start->copy()
                ->day(random_int(1, $start->daysInMonth))
                ->setTime($this->randomHour(), random_int(0, 59), random_int(0, 59));
        }

        $maxDays = match ($status) {
            'aberta' => 20,
            'em curso' => 40,
            'pendente orçamento' => 45,
            default => 10, // cancelada / recusada
        };

        return Carbon::now()->subDays(random_int(0, $maxDays))->setTime($this->randomHour(), random_int(0, 59), random_int(0, 59));
    }

    /**
     * Distribuição de minutos de resolução: ~80% dentro do SLA (<= 480).
     */
    private function closedDiffMinutes(): int
    {
        return $this->weightedPick([random_int(30, 240), random_int(241, 480), random_int(481, 900), random_int(901, 2400)], [55, 25, 12, 8]);
    }

    private function partsCost(): float
    {
        // ~65% das intervenções sem peças de maior valor.
        return round(random_int(1, 100) <= 65 ? random_int(0, 40) : random_int(40, 280), 2);
    }

    private function randomHour(): int
    {
        if (random_int(1, 100) <= 90) {
            return random_int(8, 17);
        }

        return random_int(1, 2) === 1 ? random_int(18, 23) : random_int(0, 5);
    }

    private function prioritySlaHours(string $priority): int
    {
        return match ($priority) {
            TicketPriorityEnum::Low->value => 48,
            TicketPriorityEnum::Medium->value => 24,
            TicketPriorityEnum::High->value => 8,
            default => 2,
        };
    }

    private function randomReporterName(): string
    {
        $names = OperationalData::reporterNames();

        return $names['first'][random_int(0, count($names['first']) - 1)]
            . ' ' . $names['last'][random_int(0, count($names['last']) - 1)];
    }

    private function randomPhone(): string
    {
        return '+351 9' . random_int(1, 9) . ' ' . random_int(1000000, 9999999);
    }

    /**
     * @param array<int, int> $items
     * @param array<int, int> $weights
     */
    private function weightedPick(array $items, array $weights): mixed
    {
        return $items[$this->weightedIndex($weights)];
    }

    /**
     * @param array<int, int> $weights
     */
    private function weightedIndex(array $weights): int
    {
        $total = array_sum($weights);
        $roll = random_int(1, max(1, $total));
        $running = 0;

        foreach ($weights as $index => $weight) {
            $running += $weight;
            if ($roll <= $running) {
                return $index;
            }
        }

        return count($weights) - 1;
    }
}
