<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Destinatário
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Conteúdo
            |--------------------------------------------------------------------------
            */

            $table->string('title', 150);

            $table->text('message');

            $table->enum('type', [
                'ticket_created',
                'ticket_updated',
                'ticket_assigned',
                'ticket_closed',
                'comment_added',
                'attachment_added',
                'budget_requested',
                'budget_request',
                'budget_submitted',
                'budget_approved',
                'budget_rejected',
                'budget_auto_approved',
                'priority_override',
                'system',
            ])->default('system');

            $table->enum('priority', [
                'low',
                'normal',
                'high',
                'critical',
            ])->default('normal');

            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_read')
                ->default(false);

            $table->timestamp('read_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Navegação
            |--------------------------------------------------------------------------
            */

            $table->string('link', 2048)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Entidade relacionada (Polimórfica)
            |--------------------------------------------------------------------------
            */

            $table->string('notifiable_type', 150)
                ->nullable();

            $table->unsignedBigInteger('notifiable_id')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Dados adicionais
            |--------------------------------------------------------------------------
            */

            $table->json('data')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Expiração
            |--------------------------------------------------------------------------
            */

            $table->timestamp('expires_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            // Pending notifications for the user
            $table->index(
                ['user_id', 'is_read', 'created_at'],
                'notifications_unread_idx'
            );

            // Notification history for the user
            $table->index(
                ['user_id', 'created_at'],
                'notifications_user_created_idx'
            );

            // Filter by type
            $table->index(
                ['type', 'created_at'],
                'notifications_type_created_idx'
            );

            // Related entity
            $table->index(
                ['notifiable_type', 'notifiable_id'],
                'notifications_notifiable_idx'
            );

            // Priority for urgent alerts
            $table->index(
                ['priority', 'is_read', 'created_at'],
                'notifications_priority_idx'
            );

            // Automatic expiration
            $table->index(
                'expires_at',
                'notifications_expires_idx'
            );

            // Soft deletes
            $table->index(
                ['deleted_at', 'user_id'],
                'notifications_deleted_user_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
