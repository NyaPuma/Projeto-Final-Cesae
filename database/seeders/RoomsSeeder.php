<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    public function run(): void
    {
        $seedRooms = [
            ['name' => 'Linha de Montagem A', 'code' => 'LM-A', 'location' => 'Pavilhão Industrial 1'],
            ['name' => 'Laboratório de I&D', 'code' => 'LAB-ID', 'location' => 'Edifício Central - Piso 2'],
            ['name' => 'Armazém Logístico', 'code' => 'ARM-SUL', 'location' => 'Pavilhão Sul'],
        ];

        foreach ($seedRooms as $room) {
            DB::table('rooms')->updateOrInsert(
                ['name' => $room['name']],
                ['code' => $room['code'], 'name' => $room['name'], 'location' => $room['location'], 'active' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        $targetCount = 100;
        $currentCount = DB::table('rooms')->count();

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $zone = $index % 4 === 0 ? 'Zona Norte' : ($index % 3 === 0 ? 'Zona Sul' : 'Zona Centro');
            $name = sprintf('Sala Operacional %03d', $index);
            $code = sprintf('SALA-%03d', $index);

            DB::table('rooms')->updateOrInsert(
                ['name' => $name],
                ['code' => $code, 'name' => $name, 'location' => $zone.' - Setor '.$index, 'active' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
