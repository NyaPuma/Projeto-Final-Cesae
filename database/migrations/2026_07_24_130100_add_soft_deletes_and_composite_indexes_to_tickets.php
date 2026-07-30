<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Soft deletes + status para queries de "tickets ativos"
            $table->index(['deleted_at', 'status_id'], 'tickets_deleted_status_idx');

            // Prioridade + status para dashboard de urgentes
            $table->index(['priority', 'status_id', 'deleted_at'], 'tickets_priority_status_active_idx');

            // Agendamento eficiente (só tickets não apagados com data de agendamento)
            $table->index(['scheduled', 'scheduled_at', 'deleted_at'], 'tickets_scheduled_active_idx');

            // Orçamento pendente
            $table->index(['budget_status', 'deleted_at'], 'tickets_budget_active_idx');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('tickets_budget_active_idx');
            $table->dropIndex('tickets_scheduled_active_idx');
            $table->dropIndex('tickets_priority_status_active_idx');
            $table->dropIndex('tickets_deleted_status_idx');
        });
    }
};
