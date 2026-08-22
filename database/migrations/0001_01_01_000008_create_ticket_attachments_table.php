<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_attachments', function (Blueprint $table) {
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

            /*
            |--------------------------------------------------------------------------
            | Informação do Ficheiro
            |--------------------------------------------------------------------------
            */

            $table->string('original_name', 255);

            $table->string('file_name', 255);

            $table->string('path', 1024);

            $table->string('disk', 50)
                ->default('public');

            $table->string('extension', 20)
                ->nullable();

            $table->string('mime_type', 100);

            $table->unsignedBigInteger('size');

            $table->string('checksum', 64)
                ->nullable();

            $table->text('description')
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

            // Listagem de anexos por ticket (mais frequente)
            $table->index(
                ['ticket_id', 'created_at'],
                'attachments_ticket_created_idx'
            );

            // Pesquisa de anexos por tipo
            $table->index(
                ['ticket_id', 'mime_type'],
                'attachments_ticket_mime_idx'
            );

            // Extension filters
            $table->index(
                'extension',
                'attachments_extension_idx'
            );

            // Pesquisa por hash (duplicados/integridade)
            $table->index(
                'checksum',
                'attachments_checksum_idx'
            );

            // Chronological ordering
            $table->index(
                'created_at',
                'attachments_created_at_idx'
            );

            // Soft Deletes
            $table->index(
                ['deleted_at', 'ticket_id'],
                'attachments_deleted_ticket_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_attachments');
    }
};
