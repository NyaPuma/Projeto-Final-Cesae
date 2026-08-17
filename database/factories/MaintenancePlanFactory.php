<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\MaintenancePlanIntervalTypeEnum;
use App\Models\Equipment;
use App\Models\MaintenancePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MaintenancePlan>
 */
class MaintenancePlanFactory extends Factory
{
    protected $model = MaintenancePlan::class;

    public function definition(): array
    {
        $intervalType = $this->faker->randomElement(MaintenancePlanIntervalTypeEnum::cases());

        return [
            'equipment_id' => Equipment::factory(),
            'name' => $this->faker->unique()->words(3, true),
            'interval_type' => $intervalType->value,
            'interval_value' => match ($intervalType) {
                MaintenancePlanIntervalTypeEnum::Days => $this->faker->randomElement([30, 60, 90, 180, 365]),
                MaintenancePlanIntervalTypeEnum::UsageHours => $this->faker->randomElement([250, 500, 1000, 2000]),
                MaintenancePlanIntervalTypeEnum::Cycles => $this->faker->randomElement([100, 500, 1000]),
            },
            'description' => $this->faker->optional()->sentence(),
            'active' => true,
        ];
    }
}
