<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona as colunas de recomendação automática de técnico (IA) à tabela tickets.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('recommended_technician_id')->nullable()->after('closed_by');
            $table->text('ai_recommendation_reason')->nullable()->after('recommended_technician_id');
            $table->timestamp('ai_processed_at')->nullable()->after('ai_recommendation_reason');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['recommended_technician_id', 'ai_recommendation_reason', 'ai_processed_at']);
        });
    }
};
