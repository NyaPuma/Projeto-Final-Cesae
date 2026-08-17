<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\MaintenancePlanIntervalTypeEnum;
use App\Models\Equipment;
use App\Models\MaintenancePlan;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final readonly class MaintenancePlanActions
{
    /**
     * @param  array<int, int>  $parts  mapa part_id => expected_quantity
     */
    public function create(
        Equipment $equipment,
        string $name,
        MaintenancePlanIntervalTypeEnum $intervalType,
        int $intervalValue,
        ?string $description = null,
        bool $active = true,
        array $parts = [],
    ): MaintenancePlan {
        return DB::transaction(function () use ($equipment, $name, $intervalType, $intervalValue, $description, $active, $parts) {
            $plan = MaintenancePlan::create([
                'equipment_id' => $equipment->id,
                'name' => trim($name),
                'interval_type' => $intervalType->value,
                'interval_value' => $intervalValue,
                'description' => $description ? trim($description) : null,
                'active' => $active,
            ]);

            $this->syncParts($plan, $parts);

            return $plan->load(['equipment', 'parts']);
        });
    }

    /**
     * @param  array<int, int>  $parts  mapa part_id => expected_quantity
     */
    public function update(
        MaintenancePlan $plan,
        string $name,
        MaintenancePlanIntervalTypeEnum $intervalType,
        int $intervalValue,
        ?string $description = null,
        bool $active = true,
        array $parts = [],
    ): MaintenancePlan {
        return DB::transaction(function () use ($plan, $name, $intervalType, $intervalValue, $description, $active, $parts) {
            $plan->update([
                'name' => trim($name),
                'interval_type' => $intervalType->value,
                'interval_value' => $intervalValue,
                'description' => $description ? trim($description) : null,
                'active' => $active,
            ]);

            $this->syncParts($plan, $parts);

            return $plan->load(['equipment', 'parts']);
        });
    }

    /**
     * @param  array<int, int>  $parts  mapa part_id => expected_quantity
     */
    private function syncParts(MaintenancePlan $plan, array $parts): void
    {
        $payload = [];

        foreach ($parts as $partId => $quantity) {
            $partId = (int) $partId;
            $quantity = (int) $quantity;

            if ($partId < 1) {
                continue;
            }

            if ($quantity < 1) {
                throw new InvalidArgumentException('A quantidade esperada de cada peça deve ser pelo menos 1.');
            }

            $payload[$partId] = ['expected_quantity' => $quantity];
        }

        $plan->parts()->sync($payload);
    }
}
