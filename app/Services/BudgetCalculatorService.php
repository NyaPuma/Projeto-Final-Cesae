<?php

namespace App\Services;

use App\Models\Ticket;

final class BudgetCalculatorService
{
    public function calculateTotalMaterialCost(Ticket $ticket): float
    {
        return $this->calculateByType($ticket, 'material');
    }

    public function calculateTotalLaborCost(Ticket $ticket): float
    {
        return $this->calculateByType($ticket, 'labor');
    }

    public function calculateBudgetTotal(Ticket $ticket): float
    {
        return $this->calculateTotalMaterialCost($ticket) + $this->calculateTotalLaborCost($ticket);
    }

    public function getBreakdown(Ticket $ticket): array
    {
        $materialItems = [];
        $laborItems = [];
        $details = $ticket->budget_details ?? [];

        foreach ($details as $item) {
            $type = $item['type'] ?? 'material';

            if ($type === 'labor') {
                $subtotal = ($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0);
                $laborItems[] = array_merge($item, ['subtotal' => $subtotal]);
            } else {
                $subtotal = ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                $materialItems[] = array_merge($item, ['subtotal' => $subtotal]);
            }
        }

        $materialTotal = collect($materialItems)->sum('subtotal');
        $laborTotal = collect($laborItems)->sum('subtotal');

        return [
            'materials' => $materialItems,
            'labor' => $laborItems,
            'material_total' => $materialTotal,
            'labor_total' => $laborTotal,
            'grand_total' => $materialTotal + $laborTotal,
        ];
    }

    private function calculateByType(Ticket $ticket, string $type): float
    {
        $total = 0;
        $details = $ticket->budget_details ?? [];

        foreach ($details as $item) {
            $itemType = $item['type'] ?? 'material';

            if ($itemType === $type) {
                $total += $type === 'labor'
                    ? ($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0)
                    : ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
            }
        }

        return $total;
    }
}
