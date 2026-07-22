<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // O Técnico insere a estimativa (pode ser nulo até o técnico avaliar)
            $table->decimal('custo_estimado', 10, 2)->nullable()->after('status_id');

            // O Administrador clica no botão "Aprovar" (por defeito começa em falso)
            $table->boolean('orcamento_aprovado')->default(false)->after('custo_estimado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Remove as colunas caso façam rollback
            $table->dropColumn(['custo_estimado', 'orcamento_aprovado']);
        });
    }
};
