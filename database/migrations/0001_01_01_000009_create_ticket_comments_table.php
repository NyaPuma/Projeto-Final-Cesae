<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_comments', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('ticket_comments')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Comentário
            |--------------------------------------------------------------------------
            */

            $table->text('comment');

            $table->boolean('is_internal')
                ->default(false);

            $table->timestamp('edited_at')
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
            | Índices
            |--------------------------------------------------------------------------
            */

            // Listagem cronológica de comentários por ticket
            $table->index(
                ['ticket_id', 'created_at'],
                'ticket_comments_ticket_created_idx'
            );

            // Comentários internos por ticket
            $table->index(
                ['ticket_id', 'is_internal'],
                'ticket_comments_ticket_internal_idx'
            );

            // Respostas (threads)
            $table->index(
                ['parent_id', 'created_at'],
                'ticket_comments_parent_created_idx'
            );

            // Comentários editados
            $table->index(
                'edited_at',
                'ticket_comments_edited_at_idx'
            );

            // Soft Deletes
            $table->index(
                ['deleted_at', 'ticket_id'],
                'ticket_comments_deleted_ticket_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_comments');
    }
};
