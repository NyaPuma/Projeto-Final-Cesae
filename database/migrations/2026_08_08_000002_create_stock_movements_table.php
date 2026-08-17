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
        | Movimentos de Stock
        |--------------------------------------------------------------------------
        */

        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('part_id')
                ->constrained('parts')
                ->cascadeOnDelete();

            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained('tickets')
                ->nullOnDelete();

            $table->foreignId('equipment_id')
                ->nullable()
                ->constrained('equipments')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Movimento
            |--------------------------------------------------------------------------
            */

            $table->enum('movement_type', [
                'in',
                'out',
                'adjust',
                'return',
            ]);

            $table->integer('quantity');

            $table->string('reason', 255)
                ->nullable();

            $table->decimal('unit_price_snapshot', 10, 2)
                ->nullable();

            $table->integer('stock_after');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index([
                'part_id',
                'created_at',
            ]);

            $table->index([
                'movement_type',
                'created_at',
            ]);

            $table->index('ticket_id');

            $table->index('equipment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
