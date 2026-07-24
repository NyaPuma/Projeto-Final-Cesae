<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BulkOperationalDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserProfilesSeeder::class,
            UsersSeeder::class,
            RoomsSeeder::class,
            EquipmentCategoriesSeeder::class,
            EquipmentsSeeder::class,
            TicketsSeeder::class,
        ]);
    }
}
