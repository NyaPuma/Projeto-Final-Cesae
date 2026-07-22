<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (! Schema::hasColumn('tickets', 'budget_requested_at')) {
                $table->timestamp('budget_requested_at')->nullable()->after('budget_status');
            }
            if (! Schema::hasColumn('tickets', 'budget_decided_at')) {
                $table->timestamp('budget_decided_at')->nullable()->after('budget_requested_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $columnsToDrop = array_filter(
                ['budget_requested_at', 'budget_decided_at'],
                fn ($col) => Schema::hasColumn('tickets', $col)
            );
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
