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
        Schema::table('notifications', function (Blueprint $table) {
            $table->index('user_id', 'notifications_user_id_sup_idx');
            $table->index(['user_id', 'is_read'], 'notifications_user_read_idx');
            $table->index(['user_id', 'created_at'], 'notifications_user_created_idx');
        });

        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->index(['ticket_id', 'created_at'], 'ticket_comments_ticket_created_idx');
        });

        Schema::table('equipments', function (Blueprint $table) {
            $table->index('category_id', 'equipments_category_id_idx');
            $table->index(['category_id', 'active'], 'equipments_category_active_idx');
        });

        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            $table->index('ticket_id', 'wh_ticket_id_idx');
            $table->index('technician_id', 'wh_technician_id_idx');
        });
    }

    public function down(): void
    {
        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            $table->dropIndex('wh_technician_id_idx');
            $table->dropIndex('wh_ticket_id_idx');
        });

        Schema::table('equipments', function (Blueprint $table) {
            $table->dropIndex('equipments_category_active_idx');
            $table->dropIndex('equipments_category_id_idx');
        });

        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->dropIndex('ticket_comments_ticket_created_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex('notifications_user_created_idx');
            $table->dropIndex('notifications_user_read_idx');
            $table->dropIndex('notifications_user_id_sup_idx');
        });
    }
};
