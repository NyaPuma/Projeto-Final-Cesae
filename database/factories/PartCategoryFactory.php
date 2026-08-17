<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PartCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PartCategory>
 */
class PartCategoryFactory extends Factory
{
    protected $model = PartCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Rolamentos',
                'Correias e Polias',
                'Componentes Elétricos',
                'Componentes Hidráulicos',
                'Componentes Pneumáticos',
                'Fixadores',
                'Vedações',
                'Lubrificantes',
                'Filtros',
                'Sensores',
            ]),
            'active' => true,
        ];
    }
}
