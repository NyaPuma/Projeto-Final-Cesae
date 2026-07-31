<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Converte as tabelas do módulo de tickets para utf8mb4/utf8mb4_unicode_ci.
     *
     * Apenas corre em ligações MySQL (o ambiente de testes usa SQLite,
     * onde esta sintaxe não é suportada).
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        $tables = [
            'tickets',
            'ticket_types',
            'ticket_statuses',
            'ticket_workflow_history',
        ];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            DB::statement("ALTER TABLE `{$table}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        }
    }

    /**
     * A conversão de dados não é revertível de forma segura.
     */
    public function down(): void
    {
    }
};
