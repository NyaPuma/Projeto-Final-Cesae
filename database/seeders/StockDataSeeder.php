<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\StockMovementTypeEnum;
use App\Models\MaintenancePlan;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\Supplier;
use App\Models\TaxRate;
use App\Models\User;
use Database\Seeders\Data\OperationalData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StockDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('A semear dados de stock...');

        /*
        |--------------------------------------------------------------------------
        | Taxas de IVA
        |--------------------------------------------------------------------------
        */

        $taxRates = [
            ['name' => 'Isento', 'percent' => 0, 'is_default' => false],
            ['name' => 'Taxa Reduzida', 'percent' => 6, 'is_default' => false],
            ['name' => 'Taxa Intermédia', 'percent' => 13, 'is_default' => false],
            ['name' => 'Taxa Normal', 'percent' => 23, 'is_default' => true],
        ];

        $taxRateModels = collect($taxRates)->map(function (array $taxRate): TaxRate {
            return TaxRate::firstOrCreate(
                ['name' => $taxRate['name'], 'percent' => $taxRate['percent']],
                array_merge($taxRate, ['active' => true]),
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Categorias de peças
        |--------------------------------------------------------------------------
        */

        $categoryNames = [
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
        ];

        $categories = collect($categoryNames)->map(function (string $name): PartCategory {
            return PartCategory::firstOrCreate(
                ['name' => $name],
                ['active' => true],
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Fornecedores
        |--------------------------------------------------------------------------
        */

        $suppliers = Supplier::factory()->count(8)->create();

        /*
        |--------------------------------------------------------------------------
        | Peças
        |--------------------------------------------------------------------------
        */

        $parts = collect();

        $catalog = OperationalData::partsByCategory();

        foreach ($categories as $category) {
            $catalogItems = $catalog[$category->name] ?? [];

            for ($i = 0; $i < 8; $i++) {
                $item = $catalogItems[$i] ?? [
                    'name' => 'Peça de reserva ' . ($i + 1),
                    'brand' => 'Genérico',
                    'manufacturer_ref' => 'GEN-' . ($i + 1),
                    'cost_min' => 5,
                    'cost_max' => 40,
                ];

                $cost = random_int((int) ($item['cost_min'] * 100), (int) ($item['cost_max'] * 100)) / 100;

                $parts->push(Part::factory()->create([
                    'part_category_id' => $category->id,
                    'tax_rate_id' => $taxRateModels->random()->id,
                    'name' => $item['name'],
                    'brand' => $item['brand'],
                    'manufacturer_ref' => $item['manufacturer_ref'],
                    'cost_price' => $cost,
                    'sale_price' => round($cost * 1.35, 2),
                ]));
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Relação Fornecedor ↔ Peça (pivot)
        |--------------------------------------------------------------------------
        */

        $parts->each(function (Part $part) use ($suppliers): void {
            $part->suppliers()->attach(
                $suppliers->random(rand(1, 3))->pluck('id')->all(),
                [
                    'price' => fake()->randomFloat(2, 1, 300),
                    'supplier_ref' => strtoupper(fake()->bothify('REF-####')),
                    'lead_time_days' => fake()->numberBetween(2, 20),
                ],
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Movimentos de stock (histórico)
        |--------------------------------------------------------------------------
        */

        $technicians = User::whereHas('profile', fn ($q) => $q->whereIn('name', ['admin', 'technician']))
            ->get()
            ->take(10);

        $windowStart = Carbon::now()->startOfMonth()->subMonths(5);
        $windowEnd = Carbon::now()->endOfMonth();

        foreach ($parts->take(60) as $part) {
            $initial = max(0, $part->current_stock);
            $stockAfter = $initial;

            if ($initial > 0) {
                $createdAt = $this->randomDateWithin($windowStart, $windowEnd);

                DB::table('stock_movements')->insert([
                    'part_id' => $part->id,
                    'user_id' => $technicians->isNotEmpty() ? $technicians->random()->id : null,
                    'movement_type' => StockMovementTypeEnum::In->value,
                    'quantity' => $initial,
                    'reason' => 'Stock inicial de catalogação',
                    'unit_price_snapshot' => (float) $part->cost_price,
                    'stock_after' => $initial,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            for ($i = 0; $i < rand(2, 8); $i++) {
                $type = fake()->randomElement([
                    StockMovementTypeEnum::Out,
                    StockMovementTypeEnum::Adjust,
                    StockMovementTypeEnum::Return,
                ]);

                $quantity = match ($type) {
                    StockMovementTypeEnum::Out => -rand(1, 8),
                    StockMovementTypeEnum::Adjust => rand(-4, 6),
                    StockMovementTypeEnum::Return => rand(1, 4),
                    default => 0,
                };

                if ($quantity === 0) {
                    continue;
                }

                $stockAfter = max(0, $stockAfter + $quantity);
                $createdAt = $this->randomDateWithin($windowStart, $windowEnd);

                DB::table('stock_movements')->insert([
                    'part_id' => $part->id,
                    'user_id' => $technicians->isNotEmpty() ? $technicians->random()->id : null,
                    'movement_type' => $type->value,
                    'quantity' => $quantity,
                    'reason' => match ($type) {
                        StockMovementTypeEnum::Out => 'Consumo em intervenção',
                        StockMovementTypeEnum::Adjust => 'Ajuste de inventário',
                        StockMovementTypeEnum::Return => 'Devolução de sobrante',
                        default => 'Entrada',
                    },
                    'unit_price_snapshot' => (float) $part->cost_price,
                    'stock_after' => $stockAfter,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            if ($stockAfter !== $part->current_stock) {
                $part->update(['current_stock' => $stockAfter]);
            }
        }

        $parts->random(min(15, $parts->count()))->each(function (Part $part) use ($technicians, $windowEnd): void {
            $lowStock = rand(0, 3);
            $minStock = rand(5, 15);

            if ($lowStock > $part->current_stock) {
                return;
            }

            $delta = $lowStock - $part->current_stock;

            $part->update([
                'current_stock' => $lowStock,
                'min_stock' => $minStock,
            ]);

            $createdAt = $this->randomDateWithin($windowEnd->copy()->startOfMonth(), $windowEnd);

            DB::table('stock_movements')->insert([
                'part_id' => $part->id,
                'user_id' => $technicians->isNotEmpty() ? $technicians->random()->id : null,
                'movement_type' => StockMovementTypeEnum::Adjust->value,
                'quantity' => $delta,
                'reason' => 'Ajuste de inventário — stock mínimo',
                'unit_price_snapshot' => (float) $part->cost_price,
                'stock_after' => $lowStock,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Planos de manutenção preventiva
        |--------------------------------------------------------------------------
        */

        \App\Models\Equipment::query()->active()->inRandomOrder()->limit(15)->get()
            ->each(function (\App\Models\Equipment $equipment) use ($parts): void {
                $plan = MaintenancePlan::factory()->create([
                    'equipment_id' => $equipment->id,
                ]);

                $plan->parts()->attach(
                    $parts->random(rand(2, 5))->pluck('id')->all(),
                    ['expected_quantity' => rand(1, 4)],
                );
            });

        $this->command?->info('Dados de stock semeados com sucesso.');
    }

    private function randomDateWithin(Carbon $start, Carbon $end): Carbon
    {
        $days = (int) $start->diffInDays($end);

        return $start->copy()
            ->addDays(random_int(0, max(0, $days)))
            ->setTime(random_int(8, 17), random_int(0, 59), random_int(0, 59));
    }
}
