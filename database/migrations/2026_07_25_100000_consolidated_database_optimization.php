<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // --- AUDITS: índice para queries de auditoria por evento ---
        Schema::table('audits', function (Blueprint $table) {
            $table->index('event', 'audits_event_idx');
        });

        // --- TICKETS: índice cobridor para dashboard de prioridade ---
        Schema::table('tickets', function (Blueprint $table) {
            $table->index(['status_id', 'priority', 'deleted_at'], 'tickets_status_priority_active_idx');
            $table->index(['equipment_id', 'status_id'], 'tickets_equipment_status_idx');
        });

        // --- NOTIFICATIONS: índice para queries "não lidas" ---
        Schema::table('notifications', function (Blueprint $table) {
            $table->index(['user_id', 'is_read', 'created_at'], 'notifications_unread_idx');
        });

        // --- USERS: índice composto para lookup de técnicos ativos ---
        Schema::table('users', function (Blueprint $table) {
            $table->index(['active', 'deleted_at'], 'users_active_not_deleted_idx');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_active_not_deleted_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex('notifications_unread_idx');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('tickets_equipment_status_idx');
            $table->dropIndex('tickets_status_priority_active_idx');
        });

        Schema::table('audits', function (Blueprint $table) {
            $table->dropIndex('audits_event_idx');
        });
    }
};
