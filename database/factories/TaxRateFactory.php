<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaxRate>
 */
class TaxRateFactory extends Factory
{
    protected $model = TaxRate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Isento',
                'Taxa Reduzida',
                'Taxa Intermédia',
                'Taxa Normal',
            ]),
            'percent' => $this->faker->randomElement([0, 6, 13, 23]),
            'is_default' => false,
            'active' => true,
        ];
    }

    public function normal(): static
    {
        return $this->state(fn () => [
            'name' => 'Taxa Normal',
            'percent' => 23,
            'is_default' => true,
        ]);
    }
}
