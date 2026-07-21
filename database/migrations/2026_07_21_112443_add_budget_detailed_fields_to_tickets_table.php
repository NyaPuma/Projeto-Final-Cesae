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
            // Orçamento detalhado em formato JSON: lista de itens (descrição, quantidade, preço unitário)
            $table->json('budget_details')->nullable()->after('budget_amount');
            
            // Timestamps para controlo do tempo de pausa orçamental (SLA)
            $table->timestamp('budget_requested_at')->nullable()->after('budget_details');
            $table->timestamp('budget_decided_at')->nullable()->after('budget_requested_at');
            
            // Feedback do administrador ao recusar orçamento
            $table->text('budget_feedback')->nullable()->after('budget_decided_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'budget_details',
                'budget_requested_at',
                'budget_decided_at',
                'budget_feedback',
            ]);
        });
    }
};

