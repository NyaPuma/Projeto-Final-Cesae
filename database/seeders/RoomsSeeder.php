<?php

namespace Database\Seeders;

use Database\Seeders\Data\OperationalData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'Linha de Montagem A', 'code' => 'LM-A', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0', 'location' => 'Pavilhão Industrial 1'],
            ['name' => 'Laboratório de I&D', 'code' => 'LAB-ID', 'building' => 'Edifício Central', 'floor' => 'Piso 2', 'location' => 'Edifício Central - Piso 2'],
            ['name' => 'Armazém Logístico', 'code' => 'ARM-SUL', 'building' => 'Pavilhão Sul', 'floor' => 'Piso 0', 'location' => 'Pavilhão Sul'],
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->updateOrInsert(
                ['name' => $room['name']],
                [
                    'name' => $room['name'],
                    'code' => $room['code'],
                    'building' => $room['building'],
                    'floor' => $room['floor'],
                    'location' => $room['location'],
                    'capacity' => 10,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $catalogCount = DB::table('rooms')->where('code', 'like', 'SALA-C%')->count();

        foreach (OperationalData::rooms() as $room) {
            if (DB::table('rooms')->where('name', $room['name'])->exists()) {
                continue;
            }

            $catalogCount++;

            DB::table('rooms')->insert([
                'name' => $room['name'],
                'code' => sprintf('SALA-C%02d', $catalogCount),
                'building' => $room['building'],
                'floor' => $room['floor'],
                'location' => $room['building'].' · '.$room['floor'],
                'capacity' => 15,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $targetCount = 45;
        $currentCount = DB::table('rooms')->count();
        $buildings = ['Pavilhão Industrial 1', 'Pavilhão Industrial 2', 'Pavilhão Norte', 'Pavilhão Sul', 'Edifício Central'];
        $zones = ['Zona Norte', 'Zona Sul', 'Zona Centro', 'Zona Este'];

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $building = $buildings[$index % count($buildings)];
            $zone = $zones[$index % count($zones)];
            $name = sprintf('%s · Setor %03d', $zone, $index);
            $code = sprintf('SALA-%03d', $index);

            DB::table('rooms')->updateOrInsert(
                ['name' => $name],
                [
                    'name' => $name,
                    'code' => $code,
                    'building' => $building,
                    'floor' => 'Piso 0',
                    'location' => $building.' · '.$zone.' · Setor '.$index,
                    'capacity' => 20,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Ensure realistic distribution: ~85% active, ~15% inactive
        $totalRooms = DB::table('rooms')->count();
        $inactiveCount = (int) floor($totalRooms * 0.15);

        $activeRooms = DB::table('rooms')->where('active', true)->pluck('id')->shuffle()->take($inactiveCount);

        DB::table('rooms')->whereIn('id', $activeRooms)->update(['active' => false]);
    }
}
