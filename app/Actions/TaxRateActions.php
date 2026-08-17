<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\TaxRate;
use Illuminate\Support\Facades\DB;

final readonly class TaxRateActions
{
    public function create(string $name, float $percent, bool $isDefault = false, bool $active = true): TaxRate
    {
        return DB::transaction(function () use ($name, $percent, $isDefault, $active) {
            if ($isDefault) {
                TaxRate::query()->where('is_default', true)->update(['is_default' => false]);
            }

            $taxRate = TaxRate::create([
                'name' => trim($name),
                'percent' => $percent,
                'is_default' => $isDefault,
                'active' => $active,
            ]);

            return $taxRate;
        });
    }

    public function update(TaxRate $taxRate, string $name, float $percent, bool $isDefault = false, bool $active = true): TaxRate
    {
        return DB::transaction(function () use ($taxRate, $name, $percent, $isDefault, $active) {
            if ($isDefault) {
                TaxRate::query()
                    ->where('is_default', true)
                    ->whereKeyNot($taxRate->getKey())
                    ->update(['is_default' => false]);
            }

            $taxRate->update([
                'name' => trim($name),
                'percent' => $percent,
                'is_default' => $isDefault,
                'active' => $active,
            ]);

            return $taxRate;
        });
    }
}
