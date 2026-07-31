<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixTicketEncoding extends Command
{
    protected $signature = 'tickets:fix-encoding
                    {--dry-run : Apenas lista os registos afetados sem alterar dados}';

    protected $description = 'Repara registos de tickets com Mojibake (dupla codificação latin1/utf8mb4)';

    public function handle(): int
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            $this->error('Este comando só funciona em ligações MySQL.');

            return self::FAILURE;
        }

        if (! Schema::hasTable('tickets')) {
            $this->error('A tabela tickets não existe.');

            return self::FAILURE;
        }

        $dryRun = (bool) $this->option('dry-run');

        $columns = [
            'title',
            'description',
            'resolution_summary',
            'resolution',
            'technical_report',
            'budget_feedback',
        ];

        $total = 0;

        foreach ($columns as $column) {
            if (! Schema::hasColumn('tickets', $column)) {
                continue;
            }

            $ids = $this->affectedIds($column);

            if ($ids === []) {
                continue;
            }

            $this->line("  tickets.{$column}: " . count($ids) . " registo(s) afetado(s).");

            if (! $dryRun) {
                $idList = implode(',', $ids);

                DB::statement(
                    "UPDATE `tickets` SET `{$column}` = CONVERT(CAST(CONVERT(`{$column}` USING latin1) AS BINARY) USING utf8mb4) WHERE `id` IN ({$idList});"
                );
            }

            $total += count($ids);
        }

        if ($total === 0) {
            $this->info('Sem registos com mojibake na tabela tickets.');

            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->info("[dry-run] {$total} registo(s) seriam corrigidos.");

            return self::SUCCESS;
        }

        $this->info("Correção concluída: {$total} registo(s) corrigido(s).");

        return self::SUCCESS;
    }

    /**
     * Devolve os ids cujo texto está genuinamente dupla-codificado.
     *
     * A deteção é byte-preciso: apenas ocorrências de "Ã" (0xC3 0x83) ou
     * "Â" (0xC2 0x82) seguidas de um byte de continuação (0xC2 0x80-0xBF).
     * Um LIKE simples com collation accent-insensitive apanha qualquer vogal
     * acentuada, o que causaria falsos positivos e corrupção de dados limpos.
     */
    private function affectedIds(string $column): array
    {
        $candidates = DB::table('tickets')
            ->select('id', $column)
            ->whereRaw(
                "`{$column}` LIKE BINARY CONCAT('%', CONVERT(0xC383 USING utf8mb4), '%') OR `{$column}` LIKE BINARY CONCAT('%', CONVERT(0xC282 USING utf8mb4), '%')"
            )
            ->get();

        $pattern = '/\xC3\x83[\xC2\x80-\xC2\xBF]|\xC2\x82[\xC2\x80-\xC2\xBF]/';
        $ids = [];

        foreach ($candidates as $row) {
            $value = $row->{$column};

            if (! is_string($value) || $value === '') {
                continue;
            }

            if (! preg_match($pattern, $value)) {
                continue;
            }

            // A reversão latin1 -> UTF-8 só é segura se produzir texto válido.
            $fixed = mb_convert_encoding($value, 'ISO-8859-1', 'UTF-8');

            if (! mb_check_encoding($fixed, 'UTF-8')) {
                continue;
            }

            $ids[] = $row->id;
        }

        return $ids;
    }
}
