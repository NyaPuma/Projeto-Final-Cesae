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
            if (! Schema::hasColumn('tickets', 'budget_details')) {
                $table->json('budget_details')->nullable()->after('budget_amount');
            }
            if (! Schema::hasColumn('tickets', 'budget_requested_at')) {
                $table->timestamp('budget_requested_at')->nullable()->after('budget_details');
            }
            if (! Schema::hasColumn('tickets', 'budget_decided_at')) {
                $table->timestamp('budget_decided_at')->nullable()->after('budget_requested_at');
            }
            if (! Schema::hasColumn('tickets', 'budget_feedback')) {
                $table->text('budget_feedback')->nullable()->after('budget_decided_at');
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
                ['budget_details', 'budget_requested_at', 'budget_decided_at', 'budget_feedback'],
                fn ($col) => Schema::hasColumn('tickets', $col)
            );
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
