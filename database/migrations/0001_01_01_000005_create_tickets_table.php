<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tipos de Avaria
        |--------------------------------------------------------------------------
        */

        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)
                ->unique();

            $table->string('name', 100)
                ->unique();

            $table->text('description')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Estados das Avarias
        |--------------------------------------------------------------------------
        */

        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type_id')
                ->nullable()
                ->constrained('ticket_types')
                ->nullOnDelete();

            $table->string('code', 50)
                ->unique();

            $table->string('name', 100)
                ->unique();

            $table->text('description')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'type_id',
                'active',
            ]);

            $table->index([
                'active',
                'deleted_at',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Tickets
        |--------------------------------------------------------------------------
        */

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Referência
            |--------------------------------------------------------------------------
            */

            $table->string('reference', 30)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('equipment_id')
                ->nullable()
                ->constrained('equipments')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('room_id')
                ->nullable()
                ->constrained('rooms')
                ->nullOnDelete();

            $table->foreignId('status_id')
                ->nullable()
                ->constrained('ticket_statuses')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Informação Principal
            |--------------------------------------------------------------------------
            */

            $table->string('title', 150);

            $table->text('description');

            $table->enum('priority', [
                'baixa',
                'média',
                'alta',
                'crítica',
            ])->default('média');

            $table->boolean('urgent')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Workflow
            |--------------------------------------------------------------------------
            */

            $table->timestamp('opened_at')
                ->nullable();

            $table->timestamp('assigned_at')
                ->nullable();

            $table->timestamp('first_response_at')
                ->nullable();

            $table->timestamp('in_progress_at')
                ->nullable();

            $table->timestamp('resolved_at')
                ->nullable();

            $table->timestamp('closed_at')
                ->nullable();

            $table->timestamp('reopened_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Agendamento
            |--------------------------------------------------------------------------
            */

            $table->boolean('scheduled')
                ->default(false);

            $table->timestamp('scheduled_at')
                ->nullable();

            $table->timestamp('scheduled_end')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | SLA
            |--------------------------------------------------------------------------
            */

            $table->timestamp('due_at')
                ->nullable();

            $table->boolean('sla_breached')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Resolução
            |--------------------------------------------------------------------------
            */

            $table->string('resolution_summary', 255)
                ->nullable();

            $table->text('resolution')
                ->nullable();

            $table->longText('technical_report')
                ->nullable();

            $table->unsignedInteger('estimated_minutes')
                ->nullable();

            $table->unsignedInteger('minutes_spent')
                ->nullable();

            $table->decimal('estimated_cost', 10, 2)
                ->nullable();

            $table->decimal('actual_cost', 10, 2)
                ->nullable();

            $table->foreignId('resolved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('closed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Orçamento
            |--------------------------------------------------------------------------
            */

            $table->boolean('budget_requested')
                ->default(false);

            $table->timestamp('budget_requested_at')
                ->nullable();

            $table->enum('budget_status', [
                'pendente',
                'aprovado',
                'rejeitado',
            ])
                ->nullable();

            $table->decimal('budget_amount', 10, 2)
                ->nullable();

            $table->json('budget_details')
                ->nullable();

            $table->text('budget_feedback')
                ->nullable();

            $table->timestamp('budget_approved_at')
                ->nullable();

            $table->timestamp('budget_decided_at')
                ->nullable();

            $table->foreignId('budget_approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices principais
            |--------------------------------------------------------------------------
            */

            $table->index([
                'status_id',
                'priority',
                'deleted_at',
            ]);

            $table->index([
                'assigned_to',
                'status_id',
                'deleted_at',
            ]);

            $table->index([
                'equipment_id',
                'status_id',
            ]);

            $table->index([
                'room_id',
                'status_id',
            ]);

            $table->index([
                'user_id',
                'created_at',
            ]);

            $table->index([
                'status_id',
                'opened_at',
            ]);

            $table->index([
                'assigned_to',
                'created_at',
            ]);

            $table->index([
                'scheduled',
                'scheduled_at',
                'deleted_at',
            ]);

            $table->index([
                'budget_status',
                'budget_requested',
                'deleted_at',
            ]);

            $table->index([
                'deleted_at',
                'status_id',
            ]);

            $table->index('due_at');

            $table->index('urgent');

            $table->index('sla_breached');
        });

        /*
        |--------------------------------------------------------------------------
        | Histórico do Workflow
        |--------------------------------------------------------------------------
        */

        Schema::create('ticket_workflow_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('origin_status_id')
                ->nullable()
                ->constrained('ticket_statuses')
                ->nullOnDelete();

            $table->foreignId('destination_status_id')
                ->nullable()
                ->constrained('ticket_statuses')
                ->nullOnDelete();

            $table->foreignId('technician_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('comment')
                ->nullable();

            $table->timestamps();

            $table->index([
                'ticket_id',
                'created_at',
            ]);

            $table->index([
                'technician_id',
                'created_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_workflow_history');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_statuses');
        Schema::dropIfExists('ticket_types');
    }
};
