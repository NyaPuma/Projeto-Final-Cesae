<?php

namespace Database\Seeders;

use Database\Seeders\Data\OperationalData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentsSeeder extends Seeder
{
    public function run(): void
    {
        $roomIds = DB::table('rooms')->pluck('id')->all();
        $categories = DB::table('equipment_categories')->pluck('id', 'name')->all();

        if (empty($roomIds) || empty($categories)) {
            return;
        }

        $equipment = [
            ['name' => 'Braço Robótico KUKA KR210', 'serial' => 'KUKA-KR210-2026', 'brand' => 'KUKA', 'model' => 'KR210 R2700', 'category' => 'Robótica'],
            ['name' => 'Prensa Hidráulica 50T', 'serial' => 'PRES-HYD-50T-99', 'brand' => 'Mitsubishi', 'model' => 'PH-50T', 'category' => 'Automação'],
            ['name' => 'Servidor Central Dell PowerEdge', 'serial' => 'DELL-PE-R750-SRV', 'brand' => 'Dell', 'model' => 'PowerEdge R750', 'category' => 'Infraestruturas'],
            ['name' => 'Empilhador Elétrico Toyota', 'serial' => 'TOY-ELEC-404', 'brand' => 'Toyota', 'model' => '8FBE', 'category' => 'Logística'],
        ];

        foreach ($equipment as $item) {
            DB::table('equipments')->updateOrInsert(
                ['serial' => $item['serial']],
                [
                    'name' => $item['name'],
                    'serial' => $item['serial'],
                    'brand' => $item['brand'],
                    'model' => $item['model'],
                    'room_id' => $roomIds[0] ?? 1,
                    'category_id' => $categories[$item['category']] ?? 1,
                    'status' => 'operacional',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        foreach (OperationalData::equipmentCatalog() as $item) {
            DB::table('equipments')->updateOrInsert(
                ['serial' => $item['serial']],
                [
                    'name' => $item['name'],
                    'serial' => $item['serial'],
                    'brand' => $item['brand'],
                    'model' => $item['model'],
                    'room_id' => $roomIds[array_rand($roomIds)] ?? 1,
                    'category_id' => $categories[$item['category']] ?? 1,
                    'status' => 'operacional',
                    'active' => true,
                    'notes' => $item['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $targetCount = 100;
        $currentCount = DB::table('equipments')->count();
        $categoriesIds = array_values($categories);

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $serial = sprintf('EQ-%03d-%04d', $index, random_int(1000, 9999));
            $roomId = $roomIds[array_rand($roomIds)] ?? 1;
            $categoryId = $categoriesIds[array_rand($categoriesIds)] ?? 1;

            DB::table('equipments')->updateOrInsert(
                ['serial' => $serial],
                [
                    'name' => sprintf('Equipamento Operacional %03d', $index),
                    'serial' => $serial,
                    'room_id' => $roomId,
                    'category_id' => $categoryId,
                    'status' => 'operacional',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Ensure realistic distribution: ~80% operacional, ~10% manutenção, ~5% avariado, ~5% abatido
        $totalEquipments = DB::table('equipments')->count();
        
        $operationalCount = (int) floor($totalEquipments * 0.80);
        $maintenanceCount = (int) floor($totalEquipments * 0.10);
        $brokenCount = (int) floor($totalEquipments * 0.05);
        $withdrawnCount = $totalEquipments - $operationalCount - $maintenanceCount - $brokenCount;

        // Get all equipment IDs
        $equipmentIds = DB::table('equipments')->pluck('id')->shuffle()->all();
        
        // Mark 80% as operational
        DB::table('equipments')->whereIn('id', array_slice($equipmentIds, 0, $operationalCount))
            ->update(['status' => 'operacional']);
        
        // Mark 10% as maintenance
        DB::table('equipments')->whereIn('id', array_slice($equipmentIds, $operationalCount, $maintenanceCount))
            ->update(['status' => 'manutenção']);
        
        // Mark 5% as broken
        DB::table('equipments')->whereIn('id', array_slice($equipmentIds, $operationalCount + $maintenanceCount, $brokenCount))
            ->update(['status' => 'avariado']);
        
        // Mark remaining as withdrawn
        DB::table('equipments')->whereIn('id', array_slice($equipmentIds, $operationalCount + $maintenanceCount + $brokenCount))
            ->update(['status' => 'abatido']);
    }
}
