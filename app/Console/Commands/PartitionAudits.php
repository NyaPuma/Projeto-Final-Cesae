<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class PartitionAudits extends Command
{
    protected $signature = 'audit:partition
                            {--months=12 : Número de meses para reter partições antigas}
                            {--months-ahead=3 : Número de meses futuros a criar antecipadamente}
                            {--dry-run : Exibe as operações SQL sem as executar}';

    protected $description = 'Cria e remove partições de dados reais (ALTER TABLE) na tabela de audits';

    public function handle(): int
    {
        $driver = DB::connection()->getDriverName();

        if ($driver !== 'mysql') {
            $this->warn("O particionamento nativo por RANGE nesta implementação suporta apenas MySQL/MariaDB. Driver atual: {$driver}");

            return self::FAILURE;
        }

        $monthsAhead = (int) $this->option('months-ahead');
        $monthsToKeep = (int) $this->option('months');
        $dryRun = (bool) $this->option('dry-run');

        $this->info('A verificar partições da tabela audits...');

        try {
            $this->createFuturePartitions($monthsAhead, $dryRun);
            $this->dropOldPartitions($monthsToKeep, $dryRun);

            $this->info('Gestão de partições concluída com sucesso.');

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error("Erro ao gerir partições: {$e->getMessage()}");

            return self::FAILURE;
        }
    }

    private function createFuturePartitions(int $monthsAhead, bool $dryRun): void
    {
        $existingPartitions = $this->getExistingPartitions();

        for ($i = 0; $i <= $monthsAhead; $i++) {
            // Garante o início exato do mês para evitar bugs com meses de 28/30/31 dias
            $date = now()->startOfMonth()->addMonths($i);
            $partitionName = 'p_' . $date->format('Y_m');

            if (in_array($partitionName, $existingPartitions, true)) {
                continue;
            }

            // O limite LESS THAN deve ser o primeiro dia do MÊS SEGUINTE às 00:00:00
            $upperBound = $date->copy()->addMonth()->startOfMonth()->format('Y-m-d H:i:s');

            $sql = sprintf(
                "ALTER TABLE audits REORGANIZE PARTITION p_future INTO (
                    PARTITION %s VALUES LESS THAN ('%s'),
                    PARTITION p_future VALUES LESS THAN (MAXVALUE)
                );",
                $partitionName,
                $upperBound
            );

            if ($dryRun) {
                $this->info("[DRY-RUN] Executaria SQL: {$sql}");
            } else {
                DB::statement($sql);
                $this->info("Partição criada no MySQL: {$partitionName} (dados < '{$upperBound}')");
            }
        }
    }

    private function dropOldPartitions(int $monthsToKeep, bool $dryRun): void
    {
        $cutoffDate = now()->startOfMonth()->subMonths($monthsToKeep);
        $cutoffPartitionName = 'p_' . $cutoffDate->format('Y_m');

        $existingPartitions = $this->getExistingPartitions();

        foreach ($existingPartitions as $partition) {
            // Filtra partições que seguem o padrão de nome (p_YYYY_MM)
            if (! preg_match('/^p_(\d{4})_(\d{2})$/', $partition, $matches)) {
                continue;
            }

            // Se o nome da partição for estritamente menor que a partição do limite de retenção
            if ($partition < $cutoffPartitionName) {
                $sql = "ALTER TABLE audits DROP PARTITION {$partition};";

                if ($dryRun) {
                    $this->info("[DRY-RUN] Executaria SQL para apagar: {$sql}");
                } else {
                    DB::statement($sql);
                    $this->warn("Partição antiga eliminada com sucesso (DROP PARTITION): {$partition}");
                }
            }
        }
    }

    /**
     * Obtém as partições ativas diretamente do repositório do MySQL.
     */
    private function getExistingPartitions(): array
    {
        $databaseName = DB::connection()->getDatabaseName();

        return DB::table('information_schema.partitions')
            ->where('table_schema', $databaseName)
            ->where('table_name', 'audits')
            ->whereNotNull('partition_name')
            ->pluck('partition_name')
            ->toArray();
    }
}
