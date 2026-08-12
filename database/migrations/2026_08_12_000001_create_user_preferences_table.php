<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Língua: pt, en, fr, etc.
            $table->string('language', 10)
                ->default('pt');

            // Moeda: ISO 4217 (EUR, USD, GBP, etc.)
            $table->string('currency', 3)
                ->default('EUR');

            // Formato de data: d/m/Y, m/d/Y, Y-m-d, etc.
            $table->string('date_format', 20)
                ->default('d/m/Y');

            $table->timestamps();

            // Garantir que cada utilizador tem apenas uma linha de preferências
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
