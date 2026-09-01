<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Part;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityFeedSeeder extends Seeder
{
    private const SEED_MARKER = 'seed:operational';

    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('ABORTADO: Este seeder não deve ser executado em produção!');

            return;
        }

        if (DB::table('audits')->where('url', self::SEED_MARKER)->exists()) {
            $this->command?->info('Auditorias já semeadas anteriormente.');

            return;
        }

        $technicianIds = DB::table('users')
            ->join('user_profiles', 'users.profile_id', '=', 'user_profiles.id')
            ->where('user_profiles.name', 'technician')
            ->whereNull('users.deleted_at')
            ->pluck('users.id')
            ->all();

        $adminId = DB::table('users')->where('email', 'admin@example.com')->value('id');

        if (empty($technicianIds)) {
            $this->command->error('Sem técnicos para associar à auditoria. Execute o UsersSeeder primeiro.');

            return;
        }

        $tickets = DB::table('tickets')
            ->whereNull('deleted_at')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get(['id', 'title']);

        $parts = DB::table('parts')->whereNull('deleted_at')->limit(8)->get(['id', 'name']);
        $equipments = DB::table('equipments')->whereNull('deleted_at')->limit(6)->get(['id', 'name']);
        $rooms = DB::table('rooms')->whereNull('deleted_at')->limit(4)->get(['id', 'name']);

        $audits = [];
        $now = Carbon::now();

        foreach ($tickets as $index => $ticket) {
            $hoursAgo = ($index % 22) + random_int(0, 2);
            $createdAt = $now->copy()->subHours($hoursAgo)->subMinutes(random_int(0, 59));

            $audits[] = [
                'user_id' => $technicianIds[random_int(0, count($technicianIds) - 1)],
                'auditable_type' => Ticket::class,
                'auditable_id' => $ticket->id,
                'event' => $index % 4 === 0 ? 'updated' : 'created',
                'old_values' => $index % 4 === 0 ? json_encode(['status_id' => 1]) : null,
                'new_values' => json_encode(['title' => $ticket->title, 'status_id' => $index % 4 === 0 ? 3 : 1]),
                'url' => self::SEED_MARKER,
                'ip_address' => '10.0.0.'.random_int(2, 254),
                'user_agent' => 'OperationalSeeder/1.0',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($parts as $index => $part) {
            $createdAt = $now->copy()->subHours(random_int(1, 8))->subMinutes(random_int(0, 59));

            $audits[] = [
                'user_id' => $adminId ?? $technicianIds[0],
                'auditable_type' => Part::class,
                'auditable_id' => $part->id,
                'event' => 'created',
                'old_values' => null,
                'new_values' => json_encode(['name' => $part->name]),
                'url' => self::SEED_MARKER,
                'ip_address' => '10.0.0.'.random_int(2, 254),
                'user_agent' => 'OperationalSeeder/1.0',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($equipments as $index => $equipment) {
            $createdAt = $now->copy()->subHours(random_int(2, 10))->subMinutes(random_int(0, 59));

            $audits[] = [
                'user_id' => $adminId ?? $technicianIds[0],
                'auditable_type' => Equipment::class,
                'auditable_id' => $equipment->id,
                'event' => 'created',
                'old_values' => null,
                'new_values' => json_encode(['name' => $equipment->name]),
                'url' => self::SEED_MARKER,
                'ip_address' => '10.0.0.'.random_int(2, 254),
                'user_agent' => 'OperationalSeeder/1.0',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($rooms as $index => $room) {
            $createdAt = $now->copy()->subHours(random_int(3, 12))->subMinutes(random_int(0, 59));

            $audits[] = [
                'user_id' => $adminId ?? $technicianIds[0],
                'auditable_type' => Room::class,
                'auditable_id' => $room->id,
                'event' => 'created',
                'old_values' => null,
                'new_values' => json_encode(['name' => $room->name]),
                'url' => self::SEED_MARKER,
                'ip_address' => '10.0.0.'.random_int(2, 254),
                'user_agent' => 'OperationalSeeder/1.0',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        $createdAt = $now->copy()->subHours(6)->subMinutes(20);
        $audits[] = [
            'user_id' => $adminId ?? $technicianIds[0],
            'auditable_type' => User::class,
            'auditable_id' => $technicianIds[0],
            'event' => 'created',
            'old_values' => null,
            'new_values' => json_encode(['name' => 'Técnico']),
            'url' => self::SEED_MARKER,
            'ip_address' => '10.0.0.'.random_int(2, 254),
            'user_agent' => 'OperationalSeeder/1.0',
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        foreach (array_chunk($audits, 100) as $chunk) {
            DB::table('audits')->insert($chunk);
        }

        $this->command?->info('Feed de atividade semeados com sucesso.');
    }
}
