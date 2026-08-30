<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adds missing indexes flagged by the audit:
     * - tickets.recommended_technician_id (used by AI-recommendation lookups)
     * - user_profiles.deleted_at (soft-delete filtered queries)
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->index('recommended_technician_id');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->index('deleted_at');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex(['recommended_technician_id']);
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropIndex(['deleted_at']);
        });
    }
};