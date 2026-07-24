<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adiciona colunas em falta:
     * - deleted_at (SoftDeletes no model User)
     * - token_created_at (referenciado em $casts e CustomAuthMiddleware)
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
            if (! Schema::hasColumn('users', 'token_created_at')) {
                $table->timestamp('token_created_at')->nullable()->after('api_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            if (Schema::hasColumn('users', 'token_created_at')) {
                $table->dropColumn('token_created_at');
            }
        });
    }
};
