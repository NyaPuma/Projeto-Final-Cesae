<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds indexes flagged by the performance audit:
 * - stock_movements filtered by user/ticket and ranged by created_at
 * - tickets filtered by status/priority and ranged by created_at
 * - ticket_workflow_history ranged by created_at per origin/destination status
 * - notifications filtered by read_at
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->index(['user_id', 'created_at'], 'stock_movements_user_created_idx');
            $table->index(['ticket_id', 'created_at'], 'stock_movements_ticket_created_idx');
            $table->index(['created_at'], 'stock_movements_created_idx');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->index(['status_id', 'created_at', 'deleted_at'], 'tickets_status_created_idx');
            $table->index(['priority', 'created_at', 'deleted_at'], 'tickets_priority_created_idx');
        });

        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            $table->index(['origin_status_id', 'created_at'], 'twh_origin_status_created_idx');
            $table->index(['destination_status_id', 'created_at'], 'twh_destination_status_created_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->index(['user_id', 'read_at'], 'notifications_user_read_idx');
        });
    }

    public function down(): void
    {
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->dropIndex('stock_movements_user_created_idx');
            $table->dropIndex('stock_movements_ticket_created_idx');
            $table->dropIndex('stock_movements_created_idx');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('tickets_status_created_idx');
            $table->dropIndex('tickets_priority_created_idx');
        });

        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            $table->dropIndex('twh_origin_status_created_idx');
            $table->dropIndex('twh_destination_status_created_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex('notifications_user_read_idx');
        });
    }
};
