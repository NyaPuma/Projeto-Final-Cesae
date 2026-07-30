<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Informação
            |--------------------------------------------------------------------------
            */

            $table->string('name', 100);

            $table->string('code', 50)
                ->unique();

            $table->string('building', 100)
                ->nullable();

            $table->string('floor', 50)
                ->nullable();

            $table->string('location', 255)
                ->nullable();

            $table->unsignedSmallInteger('capacity')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->text('notes')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            // Pesquisa por código único já possui índice através do UNIQUE

            // Salas por edifício e piso
            $table->index([
                'building',
                'floor',
            ]);

            // Salas ativas por edifício
            $table->index([
                'building',
                'active',
            ]);

            // Listagem geral de salas disponíveis
            $table->index([
                'active',
                'deleted_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
