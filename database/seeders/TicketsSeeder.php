<?php

namespace Database\Seeders;

use Database\Seeders\Data\OperationalData;
use Database\Seeders\Data\TicketDataset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('ABORTADO: Este seeder não deve ser executado em produção!');

            return;
        }

        $statusIds = DB::table('ticket_statuses')
            ->whereIn('name', ['aberta', 'em curso', 'fechada', 'pendente orçamento', 'cancelada', 'recusada'])
            ->pluck('id', 'name')
            ->all();

        if (count($statusIds) < 6) {
            $this->command->error('Faltam estados de ticket para semear. Execute o TicketLookupSeeder primeiro.');

            return;
        }

        $catalogWeights = collect(OperationalData::equipmentCatalog())
            ->mapWithKeys(fn ($item) => [$item['serial'] => $item['weight']])
            ->all();

        $equipmentRows = DB::table('equipments')
            ->join('equipment_categories', 'equipments.category_id', '=', 'equipment_categories.id')
            ->orderBy('equipments.id')
            ->get(['equipments.id', 'equipment_categories.name as category', 'equipments.serial'])
            ->map(fn ($row) => [
                'id' => (int) $row->id,
                'category' => $row->category,
                'weight' => $catalogWeights[$row->serial] ?? 1,
            ])
            ->all();

        $rooms = DB::table('rooms')
            ->orderBy('id')
            ->get(['id'])
            ->map(fn ($row, $index) => [
                'id' => (int) $row->id,
                'weight' => $index < 40 ? max(40 - $index, 8) : 2,
            ])
            ->all();

        $technicianIds = DB::table('users')
            ->join('user_profiles', 'users.profile_id', '=', 'user_profiles.id')
            ->where('user_profiles.name', 'technician')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id')
            ->pluck('users.id')
            ->all();

        $reporterUserIds = DB::table('users')
            ->join('user_profiles', 'users.profile_id', '=', 'user_profiles.id')
            ->where('user_profiles.name', 'user')
            ->whereNull('users.deleted_at')
            ->orderBy('users.id')
            ->pluck('users.id')
            ->all();

        if (empty($equipmentRows) || empty($rooms) || empty($technicianIds) || empty($reporterUserIds)) {
            $this->command->error('Dependências em falta: execute os seeders de salas, equipamentos e utilizadores primeiro.');

            return;
        }

        $dataset = new TicketDataset();
        $rows = $dataset->generate($statusIds, $equipmentRows, $rooms, $technicianIds, $reporterUserIds);

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('tickets')->insertOrIgnore($chunk);
        }

        $this->command?->info('Tickets sintéticos semeados com sucesso.');
    }
}
