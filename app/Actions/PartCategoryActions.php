<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\PartCategory;
use Illuminate\Support\Facades\DB;

final readonly class PartCategoryActions
{
    public function create(string $name, bool $active = true): PartCategory
    {
        return DB::transaction(function () use ($name, $active) {
            return PartCategory::create([
                'name' => trim($name),
                'active' => $active,
            ]);
        });
    }

    public function update(PartCategory $category, string $name, bool $active = true): PartCategory
    {
        return DB::transaction(function () use ($category, $name, $active) {
            $category->update([
                'name' => trim($name),
                'active' => $active,
            ]);

            return $category;
        });
    }
}
