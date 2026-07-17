<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite pode falhar se a coluna deleted_at já existir.
        // Tornamos a migration idempotente verificando antes.
        if (Schema::hasColumn('tickets', 'deleted_at')) {
            return;
        }

        Schema::table('tickets', function (Blueprint $table) {
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Remove a coluna caso faças rollback
            $table->dropSoftDeletes();
        });
    }
};
