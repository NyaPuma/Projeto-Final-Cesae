<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function safeDropIndex(string $table, string $index): void
    {
        try {
            Schema::table($table, function (Blueprint $table) use ($index) {
                $table->dropIndex($index);
            });
        } catch (\Throwable $e) {
            // Index may not exist (e.g., SQLite unique constraint shares the name)
        }
    }

    public function up(): void
    {
        $driver = DB::getDriverName();

        // These indexes are redundant because UNIQUE constraints already create indexes in MySQL.
        // In SQLite, UNIQUE constraints may share the same index name, so we guard each drop.
        $this->safeDropIndex('users', 'email');
        $this->safeDropIndex('equipments', 'serial');
        $this->safeDropIndex('ticket_statuses', 'name');
        $this->safeDropIndex('ticket_types', 'name');
        $this->safeDropIndex('user_profiles', 'name');

        // FK constrained() already creates an index; explicit indexes on same columns are redundant
        $this->safeDropIndex('ticket_comments', 'ticket_id');
        $this->safeDropIndex('ticket_comments', 'user_id');
        $this->safeDropIndex('ticket_attachments', 'ticket_id');
        $this->safeDropIndex('ticket_attachments', 'user_id');
        $this->safeDropIndex('notifications', 'notifications_user_id_sup_idx');
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->index('user_id', 'notifications_user_id_sup_idx');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            $table->index('ticket_id');
            $table->index('user_id');
        });

        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->index('ticket_id');
            $table->index('user_id');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->index('name');
        });

        Schema::table('ticket_types', function (Blueprint $table) {
            $table->index('name');
        });

        Schema::table('ticket_statuses', function (Blueprint $table) {
            $table->index('name');
        });

        Schema::table('equipments', function (Blueprint $table) {
            $table->index('serial');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
    }
};
