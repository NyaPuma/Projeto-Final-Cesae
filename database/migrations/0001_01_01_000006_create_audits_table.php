<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Utilizador
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Modelo Auditado (Polimórfico)
            |--------------------------------------------------------------------------
            */

            $table->string('auditable_type', 150);

            $table->unsignedBigInteger('auditable_id');

            /*
            |--------------------------------------------------------------------------
            | Evento
            |--------------------------------------------------------------------------
            */

            $table->enum('event', [
                'created',
                'updated',
                'deleted',
                'restored',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Alterações
            |--------------------------------------------------------------------------
            */

            $table->json('old_values')->nullable();

            $table->json('new_values')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Informação da Requisição
            |--------------------------------------------------------------------------
            */

            $table->string('url', 2048)->nullable();

            $table->string('ip_address', 45)->nullable();

            $table->text('user_agent')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            // Pesquisa por entidade auditada
            $table->index(
                ['auditable_type', 'auditable_id'],
                'audits_auditable_idx'
            );

            // Histórico de auditorias por utilizador
            $table->index(
                ['user_id', 'created_at'],
                'audits_user_created_idx'
            );

            // Pesquisa por tipo de evento
            $table->index(
                ['event', 'created_at'],
                'audits_event_created_idx'
            );

            // Ordenação cronológica
            $table->index(
                'created_at',
                'audits_created_at_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
