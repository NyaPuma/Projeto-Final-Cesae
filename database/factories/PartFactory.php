<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Part;
use App\Models\PartCategory;
use App\Models\TaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Part>
 */
class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition(): array
    {
        return [
            'sku' => strtoupper($this->faker->unique()->bothify('PC-###-????')),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->sentence(),
            'brand' => $this->faker->optional()->company(),
            'manufacturer_ref' => $this->faker->optional()->bothify('REF-####'),
            'part_category_id' => PartCategory::factory(),
            'unit_of_measure' => 'unit',
            'cost_price' => $this->faker->randomFloat(2, 1, 500),
            'tax_rate_id' => TaxRate::factory(),
            'sale_price' => $this->faker->optional()->randomFloat(2, 1, 600),
            'current_stock' => $this->faker->numberBetween(0, 200),
            'min_stock' => $this->faker->numberBetween(0, 20),
            'max_stock' => $this->faker->optional()->numberBetween(50, 500),
            'location' => $this->faker->optional()->randomElement([
                'Armazém A · Prateleira 1',
                'Armazém A · Prateleira 2',
                'Armazém B · Gaveta 3',
                'Oficina · Caixa 5',
            ]),
            'photo' => null,
            'active' => true,
            'technical_notes' => $this->faker->optional()->sentence(),
        ];
    }

    public function lowStock(): static
    {
        return $this->state(fn () => [
            'current_stock' => $this->faker->numberBetween(0, 3),
            'min_stock' => $this->faker->numberBetween(5, 15),
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn () => [
            'current_stock' => 0,
            'min_stock' => $this->faker->numberBetween(5, 15),
        ]);
    }
}
