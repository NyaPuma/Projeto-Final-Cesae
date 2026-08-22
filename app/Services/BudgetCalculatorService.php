<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;

final class BudgetCalculatorService
{
    /**
     * Calculates the total cost of materials associated with the ticket budget.
     */
    public function calculateTotalMaterialCost(Ticket $ticket): float
    {
        return $this->calculateByType($ticket, 'material');
    }

    /**
     * Calculates the total labor cost associated with the ticket budget.
     */
    public function calculateTotalLaborCost(Ticket $ticket): float
    {
        return $this->calculateByType($ticket, 'labor');
    }

    /**
     * Calculates the total global budget amount (materials + labor).
     */
    public function calculateBudgetTotal(Ticket $ticket): float
    {
        return $this->calculateTotalMaterialCost($ticket) + $this->calculateTotalLaborCost($ticket);
    }

    /**
     * Returns the detailed breakdown of ticket budget items.
     *
     * @return array{
     *     materials: array<int, array{type?: string, quantity?: float|int, unit_price?: float|int, subtotal: float, [string]: mixed}>,
     *     labor: array<int, array{type?: string, hours?: float|int, hourly_rate?: float|int, subtotal: float, [string]: mixed}>,
     *     material_total: float,
     *     labor_total: float,
     *     grand_total: float
     * }
     */
    public function getBreakdown(Ticket $ticket): array
    {
        $materialItems = [];
        $laborItems = [];
        $details = $ticket->budget_details ?? [];

        foreach ($details as $item) {
            $type = $item['type'] ?? 'material';

            if ($type === 'labor') {
                $subtotal = (float) (($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0));
                $laborItems[] = array_merge($item, ['subtotal' => $subtotal]);
            } else {
                $subtotal = (float) (($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0));
                $materialItems[] = array_merge($item, ['subtotal' => $subtotal]);
            }
        }

        $materialTotal = (float) collect($materialItems)->sum('subtotal');
        $laborTotal = (float) collect($laborItems)->sum('subtotal');

        return [
            'materials' => $materialItems,
            'labor' => $laborItems,
            'material_total' => $materialTotal,
            'labor_total' => $laborTotal,
            'grand_total' => $materialTotal + $laborTotal,
        ];
    }

    /**
     * Calculates the cost of a specific budget item type.
     */
    private function calculateByType(Ticket $ticket, string $type): float
    {
        $total = 0.0;
        $details = $ticket->budget_details ?? [];

        foreach ($details as $item) {
            $itemType = $item['type'] ?? 'material';

            if ($itemType === $type) {
                $subtotal = $type === 'labor'
                    ? (float) (($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0))
                    : (float) (($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0));

                $total += $subtotal;
            }
        }

        return (float) $total;
    }
}
