<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Robótica'],
            ['name' => 'Automação'],
            ['name' => 'Infraestruturas'],
            ['name' => 'Logística'],
        ];

        foreach ($categories as $category) {
            DB::table('equipment_categories')->updateOrInsert(
                ['name' => $category['name']],
                ['name' => $category['name'], 'active' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        $targetCount = 100;
        $currentCount = DB::table('equipment_categories')->count();

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $name = sprintf('Categoria %03d', $index);

            DB::table('equipment_categories')->updateOrInsert(
                ['name' => $name],
                ['name' => $name, 'active' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
