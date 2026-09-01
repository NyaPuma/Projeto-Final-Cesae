<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Converts the tickets module tables to utf8mb4/utf8mb4_unicode_ci.
     *
     * Only runs on MySQL connections (the testing environment uses SQLite,
     * where this syntax is not supported).
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        $tables = [
            'tickets',
            'ticket_types',
            'ticket_statuses',
            'ticket_workflow_history',
        ];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            DB::statement("ALTER TABLE `{$table}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        }
    }

    /**
     * The data conversion cannot be safely reverted.
     */
    public function down(): void {}
};
