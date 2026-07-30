<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Categorias de Equipamento
        |--------------------------------------------------------------------------
        */

        Schema::create('equipment_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)
                ->unique();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Equipamentos
        |--------------------------------------------------------------------------
        */

        Schema::create('equipments', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('room_id')
                ->nullable()
                ->constrained('rooms')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('equipment_categories')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Identificação
            |--------------------------------------------------------------------------
            */

            $table->string('name', 150);

            $table->string('asset_tag', 100)
                ->nullable()
                ->unique();

            $table->string('serial', 100)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Informação técnica
            |--------------------------------------------------------------------------
            */

            $table->string('brand', 100)
                ->nullable();

            $table->string('model', 100)
                ->nullable();

            $table->string('manufacturer', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Gestão
            |--------------------------------------------------------------------------
            */

            $table->date('purchase_date')
                ->nullable();

            $table->date('warranty_until')
                ->nullable();

            $table->enum('status', [
                'operacional',
                'manutenção',
                'avariado',
                'abatido',
            ])->default('operacional');

            $table->boolean('active')
                ->default(true);

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index([
                'room_id',
                'active',
            ]);

            $table->index([
                'category_id',
                'active',
            ]);

            $table->index([
                'room_id',
                'status',
            ]);

            $table->index([
                'category_id',
                'status',
            ]);

            $table->index([
                'status',
                'active',
            ]);

            $table->index([
                'active',
                'deleted_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_categories');
    }
};
