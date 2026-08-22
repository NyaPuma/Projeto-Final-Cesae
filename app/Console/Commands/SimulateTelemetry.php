<?php

namespace App\Console\Commands;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Telemetry simulation command for preventive maintenance.
 * Generates automatic fault tickets based on random equipment anomalies.
 */
class SimulateTelemetry extends Command
{
    protected $signature = 'telemetry:simulate
                            {--equipments=3 : Número máximo de equipamentos a verificar por execução}
                            {--probability=30 : Percentagem de probabilidade de anomalia (0-100)}
                            {--dry-run : Executa a simulação sem gravar tickets na base de dados}';

    protected $description = 'Simula telemetria de equipamentos e gera tickets de manutenção preventiva automaticamente ao detetar anomalias.';

    private array $anomalyTypes = [
        [
            'title' => 'Temperatura acima do limite operacional',
            'description' => 'O sensor de temperatura do equipamento registou valores acima dos 85°C durante um período prolongado. Recomenda-se inspeção do sistema de arrefecimento.',
            'priority' => TicketPriorityEnum::High->value,
        ],
        [
            'title' => 'Vibração anormal detetada',
            'description' => 'O acelerómetro registou padrões de vibração fora dos parâmetros normais. Poderá indicar desgaste em rolamentos ou desalinhamento mecânico.',
            'priority' => TicketPriorityEnum::Medium->value,
        ],
        [
            'title' => 'Consumo energético elevado',
            'description' => 'O sistema de monitorização registou consumo elétrico 40% acima do esperado nas últimas 6 horas. Possível avaria no motor ou sobreaquecimento.',
            'priority' => TicketPriorityEnum::Medium->value,
        ],
        [
            'title' => 'Pressão fora dos limites de segurança',
            'description' => 'O sensor de pressão reportou valores anómalos. É necessária verificação imediata para evitar riscos operacionais.',
            'priority' => TicketPriorityEnum::High->value,
        ],
        [
            'title' => 'Alerta de manutenção preventiva programada',
            'description' => 'O equipamento atingiu o intervalo de manutenção preventiva recomendado pelo fabricante (500 horas de operação). Realizar inspeção de rotina.',
            'priority' => TicketPriorityEnum::Low->value,
        ],
    ];

    public function handle(TicketStatusService $statusService): int
    {
        $maxEquipments = (int) $this->option('equipments');
        $probability = (int) $this->option('probability');
        $dryRun = (bool) $this->option('dry-run');

        $this->info('🔬 A iniciar simulação de telemetria...');

        // Find the system administrator user
        $systemUser = User::whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Admin->value))->first();

        if (! $systemUser) {
            $this->error('❌ Nenhum utilizador administrador encontrado para atribuir como autor dos tickets.');

            return self::FAILURE;
        }

        // Pre-fetch the Open status ID (resolves N+1)
        $openStatusId = $statusService->getByName(TicketStatusEnum::Open);

        // Load active equipment with eager-loaded unresolved tickets to avoid N+1
        $equipments = Equipment::where('active', true)
            ->withExists(['tickets as has_open_ticket' => function ($query) use ($openStatusId) {
                // Considera aberto se estiver em Open ou estados ativos não concluídos
                $query->where('status_id', $openStatusId);
            }])
            ->inRandomOrder()
            ->limit($maxEquipments)
            ->get();

        if ($equipments->isEmpty()) {
            $this->warn('⚠️  Nenhum equipamento ativo encontrado na base de dados.');

            return self::SUCCESS;
        }

        $ticketsCreated = 0;

        foreach ($equipments as $equipment) {
            // Avoids duplication by consulting the pre-loaded Eloquent attribute
            if ($equipment->has_open_ticket) {
                $this->line("  ⏭  Equipamento #{$equipment->id} ({$equipment->name}) já tem um ticket ativo. A ignorar.");

                continue;
            }

            // Anomaly probability test (0 to 100)
            if (random_int(1, 100) > $probability) {
                $this->line("  ✅ Equipamento #{$equipment->id} ({$equipment->name}) sem anomalias detetadas.");

                continue;
            }

            $anomaly = Arr::random($this->anomalyTypes);

            if ($dryRun) {
                $this->info("  [DRY-RUN] Criaria Ticket para equip. #{$equipment->id} ({$equipment->name}): {$anomaly['title']}");
                $ticketsCreated++;

                continue;
            }

            DB::transaction(function () use ($systemUser, $equipment, $anomaly, $openStatusId, &$ticketsCreated) {
                $ticket = Ticket::create([
                    'user_id' => $systemUser->id,
                    'equipment_id' => $equipment->id,
                    'room_id' => $equipment->room_id ?? null,
                    'title' => "[TELEMETRIA] {$anomaly['title']} — {$equipment->name}",
                    'description' => $anomaly['description'] . "\n\n" .
                                     "Equipamento: {$equipment->name}\n" .
                                     "ID do Equipamento: #{$equipment->id}\n" .
                                     'Data da anomalia: ' . now()->format('d/m/Y H:i:s') . "\n" .
                                     'Gerado automaticamente pelo sistema de telemetria.',
                    'priority' => $anomaly['priority'],
                    'status_id' => $openStatusId,
                    'opened_at' => now(),
                ]);

                $ticketsCreated++;
                $this->info("  🚨 Ticket #{$ticket->id} criado para equip. #{$equipment->id} ({$equipment->name}): {$anomaly['title']}");
            });
        }

        $prefix = $dryRun ? '[DRY-RUN] ' : '';
        $this->info("✅ Simulação concluída. {$prefix}{$ticketsCreated} ticket(s) de manutenção gerado(s).");

        return self::SUCCESS;
    }
}
