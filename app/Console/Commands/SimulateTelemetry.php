<?php

namespace App\Console\Commands;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

/**
 * Comando de simulação de telemetria para manutenção preventiva.
 * Gera tickets de avaria automáticos com base em anomalias aleatórias nos equipamentos.
 * Deve ser agendado via `routes/console.php` para execução periódica.
 *
 * Uso: php artisan telemetry:simulate
 */
class SimulateTelemetry extends Command
{
    /**
     * A assinatura e descrição do comando Artisan.
     */
    protected $signature = 'telemetry:simulate
                            {--equipments=3 : Número máximo de equipamentos a verificar por execução}
                            {--probability=30 : Percentagem de probabilidade de anomalia (0-100)}';

    protected $description = 'Simula telemetria de equipamentos e gera tickets de manutenção preventiva automaticamente quando são detetadas anomalias.';

    /**
     * Tipos de anomalia possíveis e as respetivas descrições geradas automaticamente.
     */
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

    /**
     * Execução principal do comando de simulação.
     */
    public function handle(): int
    {
        $maxEquipments = (int) $this->option('equipments');
        $probability = (int) $this->option('probability');

        $this->info('🔬 A iniciar simulação de telemetria...');

        // Buscar utilizador sistema para criar tickets automaticamente
        $systemUser = User::whereHas('profile', fn ($q) => $q->where('name', User::ROLE_ADMIN))->first();

        if (! $systemUser) {
            $this->error('❌ Nenhum utilizador administrador encontrado para criar tickets automaticamente.');

            return Command::FAILURE;
        }

        // Selecionar equipamentos ativos aleatoriamente
        $equipments = Equipment::where('active', true)
            ->inRandomOrder()
            ->limit($maxEquipments)
            ->get();

        if ($equipments->isEmpty()) {
            $this->warn('⚠️  Nenhum equipamento ativo encontrado na base de dados.');

            return Command::SUCCESS;
        }

        $ticketsCreated = 0;

        foreach ($equipments as $equipment) {
            // Verificar se já existe um ticket aberto para este equipamento (evitar duplicação)
            $openStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);
            $existingOpen = Ticket::where('equipment_id', $equipment->id)
                ->where('status_id', $openStatusId)
                ->exists();

            if ($existingOpen) {
                $this->line("  ⏭  Equipamento #{$equipment->id} ({$equipment->name}) já tem ticket aberto. A ignorar.");

                continue;
            }

            // Simular probabilidade de anomalia
            if (rand(1, 100) > $probability) {
                $this->line("  ✅ Equipamento #{$equipment->id} ({$equipment->name}) sem anomalias detetadas.");

                continue;
            }

            // Selecionar tipo de anomalia aleatória
            $anomaly = Arr::random($this->anomalyTypes);

            $ticket = Ticket::create([
                'user_id' => $systemUser->id,
                'equipment_id' => $equipment->id,
                'room_id' => $equipment->room_id ?? null,
                'title' => "[TELEMETRIA] {$anomaly['title']} — {$equipment->name}",
                'description' => $anomaly['description']."\n\n".
                                  "Equipamento: {$equipment->name}\n".
                                  "ID do Equipamento: #{$equipment->id}\n".
                                  'Data da anomalia: '.now()->format('d/m/Y H:i:s')."\n".
                                  'Gerado automaticamente pelo sistema de telemetria.',
                'priority' => $anomaly['priority'],
                'status_id' => $openStatusId,
                'opened_at' => now(),
            ]);

            $ticketsCreated++;
            $this->info("  🚨 Ticket #{$ticket->id} criado para equip. #{$equipment->id} ({$equipment->name}): {$anomaly['title']}");
        }

        $this->info("✅ Simulação concluída. {$ticketsCreated} ticket(s) de manutenção preventiva criado(s).");

        return Command::SUCCESS;
    }
}
