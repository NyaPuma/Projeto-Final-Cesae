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
        | Planos de Manutenção Preventiva
        |--------------------------------------------------------------------------
        */

        Schema::create('maintenance_plans', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('equipment_id')
                ->constrained('equipments')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Plano
            |--------------------------------------------------------------------------
            */

            $table->string('name', 150);

            $table->enum('interval_type', [
                'days',
                'usage_hours',
                'cycles',
            ])->default('days');

            $table->integer('interval_value');

            $table->text('description')
                ->nullable();

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
                'equipment_id',
                'active',
            ]);

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Pivot Plano ↔ Peça
        |--------------------------------------------------------------------------
        */

        Schema::create('maintenance_plan_part', function (Blueprint $table) {
            $table->id();

            $table->foreignId('maintenance_plan_id')
                ->constrained('maintenance_plans')
                ->cascadeOnDelete();

            $table->foreignId('part_id')
                ->constrained('parts')
                ->cascadeOnDelete();

            $table->integer('expected_quantity')
                ->default(1);

            $table->timestamps();

            $table->unique([
                'maintenance_plan_id',
                'part_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_plan_part');
        Schema::dropIfExists('maintenance_plans');
    }
};
