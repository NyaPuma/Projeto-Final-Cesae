<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentsSeeder extends Seeder
{
    public function run(): void
    {
        $roomIds = DB::table('rooms')->pluck('id')->all();
        $categoryIds = DB::table('equipment_categories')->pluck('id')->all();

        $equipment = [
            ['name' => 'Braço Robótico KUKA KR210', 'serial' => 'KUKA-KR210-2026', 'room_id' => $roomIds[0] ?? 1, 'category_id' => $categoryIds[0] ?? 1],
            ['name' => 'Prensa Hidráulica 50T', 'serial' => 'PRES-HYD-50T-99', 'room_id' => $roomIds[0] ?? 1, 'category_id' => $categoryIds[1] ?? 1],
            ['name' => 'Servidor Central Dell PowerEdge', 'serial' => 'DELL-PE-R750-SRV', 'room_id' => $roomIds[1] ?? 1, 'category_id' => $categoryIds[2] ?? 1],
            ['name' => 'Empilhador Elétrico Toyota', 'serial' => 'TOY-ELEC-404', 'room_id' => $roomIds[2] ?? 1, 'category_id' => $categoryIds[3] ?? 1],
        ];

        foreach ($equipment as $item) {
            DB::table('equipments')->updateOrInsert(
                ['serial' => $item['serial']],
                [
                    'name' => $item['name'],
                    'serial' => $item['serial'],
                    'room_id' => $item['room_id'],
                    'category_id' => $item['category_id'],
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $targetCount = 100;
        $currentCount = DB::table('equipments')->count();

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $serial = sprintf('EQ-%03d-%04d', $index, random_int(1000, 9999));
            $roomId = $roomIds[array_rand($roomIds)] ?? 1;
            $categoryId = $categoryIds[array_rand($categoryIds)] ?? 1;

            DB::table('equipments')->updateOrInsert(
                ['serial' => $serial],
                [
                    'name' => sprintf('Equipamento Operacional %03d', $index),
                    'serial' => $serial,
                    'room_id' => $roomId,
                    'category_id' => $categoryId,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
