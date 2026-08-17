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
        | Categorias de Peças
        |--------------------------------------------------------------------------
        */

        Schema::create('part_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)
                ->unique();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Taxas de IVA
        |--------------------------------------------------------------------------
        */

        Schema::create('tax_rates', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);

            $table->decimal('percent', 5, 2);

            $table->boolean('is_default')
                ->default(false);

            $table->boolean('active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Peças
        |--------------------------------------------------------------------------
        */

        Schema::create('parts', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('part_category_id')
                ->nullable()
                ->constrained('part_categories')
                ->nullOnDelete();

            $table->foreignId('tax_rate_id')
                ->nullable()
                ->constrained('tax_rates')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Identificação
            |--------------------------------------------------------------------------
            */

            $table->string('sku', 100)
                ->unique();

            $table->string('name', 150);

            $table->text('description')
                ->nullable();

            $table->string('brand', 100)
                ->nullable();

            $table->string('manufacturer_ref', 100)
                ->nullable();

            $table->enum('unit_of_measure', [
                'unit',
                'meter',
                'liter',
                'kg',
                'pair',
                'set',
                'roll',
                'other',
            ])->default('unit');

            /*
            |--------------------------------------------------------------------------
            | Preços
            |--------------------------------------------------------------------------
            */

            $table->decimal('cost_price', 10, 2);

            $table->decimal('sale_price', 10, 2)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Controlo de Stock
            |--------------------------------------------------------------------------
            */

            $table->integer('current_stock')
                ->default(0);

            $table->integer('min_stock')
                ->default(0);

            $table->integer('max_stock')
                ->nullable();

            $table->string('location', 150)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Gestão
            |--------------------------------------------------------------------------
            */

            $table->string('photo', 255)
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->text('technical_notes')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index('current_stock');

            $table->index([
                'active',
                'deleted_at',
            ]);

            $table->index([
                'part_category_id',
                'active',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Fornecedores
        |--------------------------------------------------------------------------
        */

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);

            $table->string('nif', 30)
                ->nullable()
                ->unique();

            $table->string('contact', 100)
                ->nullable();

            $table->string('email', 150)
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->integer('avg_lead_time_days')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'name',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Pivot Fornecedor ↔ Peça
        |--------------------------------------------------------------------------
        */

        Schema::create('part_supplier', function (Blueprint $table) {
            $table->id();

            $table->foreignId('part_id')
                ->constrained('parts')
                ->cascadeOnDelete();

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnDelete();

            $table->decimal('price', 10, 2)
                ->nullable();

            $table->string('supplier_ref', 100)
                ->nullable();

            $table->integer('lead_time_days')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'part_id',
                'supplier_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('part_supplier');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('parts');
        Schema::dropIfExists('tax_rates');
        Schema::dropIfExists('part_categories');
    }
};
