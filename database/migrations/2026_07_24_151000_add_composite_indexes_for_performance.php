<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Soft-delete filtered queries: equipment, room, and assigned_to with active filter
            $table->index(['equipment_id', 'deleted_at'], 'tickets_equipment_active_idx');
            $table->index(['room_id', 'deleted_at'], 'tickets_room_active_idx');
            $table->index(['assigned_to', 'deleted_at'], 'tickets_assigned_active_idx');
        });

        Schema::table('audits', function (Blueprint $table) {
            // Ordering by most recent audit events
            $table->index('created_at', 'audits_created_at_idx');
        });

        Schema::table('equipments', function (Blueprint $table) {
            // Soft-delete filter for equipment queries
            $table->index('deleted_at', 'equipments_deleted_at_idx');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            // Composite for listing attachments per ticket ordered by time
            $table->index(['ticket_id', 'created_at'], 'attachments_ticket_created_idx');
        });

        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            // Ordering workflow history per ticket chronologically
            $table->index(['ticket_id', 'created_at'], 'wh_ticket_created_idx');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('tickets_equipment_active_idx');
            $table->dropIndex('tickets_room_active_idx');
            $table->dropIndex('tickets_assigned_active_idx');
        });

        Schema::table('audits', function (Blueprint $table) {
            $table->dropIndex('audits_created_at_idx');
        });

        Schema::table('equipments', function (Blueprint $table) {
            $table->dropIndex('equipments_deleted_at_idx');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            $table->dropIndex('attachments_ticket_created_idx');
        });

        Schema::table('ticket_workflow_history', function (Blueprint $table) {
            $table->dropIndex('wh_ticket_created_idx');
        });
    }
};
