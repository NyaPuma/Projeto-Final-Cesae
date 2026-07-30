<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id')->all();
        $equipmentIds = DB::table('equipments')->pluck('id')->all();
        $roomIds = DB::table('rooms')->pluck('id')->all();
        $statusIds = DB::table('ticket_statuses')->pluck('id')->all();

        $technicianProfileId = DB::table('user_profiles')->where('name', 'technician')->value('id');
        $technicianIds = $technicianProfileId
            ? DB::table('users')->where('profile_id', $technicianProfileId)->pluck('id')->all()
            : $userIds;

        if (empty($userIds) || empty($equipmentIds) || empty($roomIds) || empty($statusIds)) {
            return;
        }

        $baseTickets = [
            [
                'user_id' => $userIds[0],
                'assigned_to' => $userIds[1] ?? $userIds[0],
                'room_id' => $roomIds[0],
                'equipment_id' => $equipmentIds[0],
                'status_id' => $statusIds[0],
                'title' => 'Erro de comunicação no controlador do Braço Robótico',
                'description' => 'O painel apresenta o erro intermitente "E-2038 Bus Error" e interrompe a linha de produção.',
                'priority' => 'alta',
                'opened_at' => now()->subHours(4),
            ],
            [
                'user_id' => $userIds[0],
                'assigned_to' => $userIds[1] ?? $userIds[0],
                'room_id' => $roomIds[1],
                'equipment_id' => $equipmentIds[2] ?? $equipmentIds[0],
                'status_id' => $statusIds[1] ?? $statusIds[0],
                'title' => 'Lentidão crítica e sobreaquecimento no nó primário',
                'description' => 'Os discos estão com latência elevada e a ventoinha secundária parece fazer um ruído anormal.',
                'priority' => 'média',
                'opened_at' => now()->subDays(1),
                'in_progress_at' => now()->subHours(18),
            ],
            [
                'user_id' => $userIds[0],
                'assigned_to' => $userIds[1] ?? $userIds[0],
                'room_id' => $roomIds[0],
                'equipment_id' => $equipmentIds[1] ?? $equipmentIds[0],
                'status_id' => $statusIds[2] ?? $statusIds[0],
                'title' => 'Fuga de óleo visível no pistão hidráulico principal',
                'description' => 'Gotejamento constante na base da prensa após operação prolongada a alta pressão.',
                'priority' => 'alta',
                'opened_at' => now()->subDays(4),
                'in_progress_at' => now()->subDays(4)->addHours(2),
                'closed_at' => now()->subDays(3),
                'minutes_spent' => 1320,
                'cost' => 125.50,
            ],
        ];

        foreach ($baseTickets as $ticket) {
            DB::table('tickets')->insert([
                'user_id' => $ticket['user_id'],
                'assigned_to' => $ticket['assigned_to'],
                'room_id' => $ticket['room_id'],
                'equipment_id' => $ticket['equipment_id'],
                'status_id' => $ticket['status_id'],
                'title' => $ticket['title'],
                'description' => $ticket['description'],
                'priority' => $ticket['priority'],
                'opened_at' => $ticket['opened_at'],
                'in_progress_at' => $ticket['in_progress_at'] ?? null,
                'closed_at' => $ticket['closed_at'] ?? null,
                'minutes_spent' => $ticket['minutes_spent'] ?? null,
                'cost' => $ticket['cost'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $targetCount = 100;
        $currentCount = DB::table('tickets')->count();

        for ($i = 1; $i <= $targetCount - $currentCount; $i++) {
            $index = $i + $currentCount;
            $statusId = $statusIds[array_rand($statusIds)] ?? $statusIds[0];
            $priority = ['baixa', 'média', 'alta'][array_rand(['baixa', 'média', 'alta'])];

            DB::table('tickets')->insert([
                'user_id' => $userIds[array_rand($userIds)],
                'assigned_to' => $technicianIds[array_rand($technicianIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'equipment_id' => $equipmentIds[array_rand($equipmentIds)],
                'status_id' => $statusId,
                'title' => sprintf('Ocorrência sintética %03d', $index),
                'description' => sprintf('Ticket gerado automaticamente para o cenário operacional %03d.', $index),
                'priority' => $priority,
                'opened_at' => now()->subDays(rand(1, 30))->subHours(rand(1, 24)),
                'in_progress_at' => rand(0, 1) ? now()->subDays(rand(1, 20)) : null,
                'closed_at' => rand(0, 1) ? now()->subDays(rand(1, 10)) : null,
                'minutes_spent' => rand(20, 240),
                'cost' => round(rand(100, 5000) / 10, 2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
