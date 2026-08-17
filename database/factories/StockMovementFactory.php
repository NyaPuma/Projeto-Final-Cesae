<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\StockMovementTypeEnum;
use App\Models\Part;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockMovement>
 */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    public function definition(): array
    {
        $movementType = $this->faker->randomElement(StockMovementTypeEnum::cases());

        $quantity = match ($movementType) {
            StockMovementTypeEnum::In,
            StockMovementTypeEnum::Return => $this->faker->numberBetween(1, 100),
            StockMovementTypeEnum::Out => -$this->faker->numberBetween(1, 50),
            StockMovementTypeEnum::Adjust => $this->faker->numberBetween(-20, 20),
        };

        return [
            'part_id' => Part::factory(),
            'user_id' => User::factory(),
            'movement_type' => $movementType->value,
            'quantity' => $quantity,
            'reason' => $this->faker->optional()->sentence(),
            'unit_price_snapshot' => $this->faker->randomFloat(2, 1, 100),
            'stock_after' => $this->faker->numberBetween(0, 500),
        ];
    }
}
