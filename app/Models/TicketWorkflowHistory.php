<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class TicketWorkflowHistory extends Model
{
    use HasFactory;

    /**
     * Define explicitamente o nome da tabela no singular/unificado.
     */
    protected $table = 'ticket_workflow_history';

    protected $fillable = [
        'ticket_id',
        'origin_status_id',
        'destination_status_id',
        'technician_id',
        'comment',
    ];

    // --- RELAÇÕES ---

    /**
     * Chamado/Ticket associado ao histórico.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    /**
     * Estado anterior/origem da transição.
     */
    public function originStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'origin_status_id');
    }

    /**
     * Novo estado/destino da transição.
     */
    public function destinationStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'destination_status_id');
    }

    /**
     * Técnico ou utilizador que executou a mudança de estado.
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    // --- SCOPES ---

    /**
     * Scope para ordenar o histórico por ordem cronológica decrescente (do mais recente ao mais antigo).
     */
    public function scopeChronological(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    // --- ACCESSORS ---

    /**
     * Retorna uma representação em texto da transição (ex: "Aberto ➔ Em Progresso").
     */
    protected function transitionLabel(): Attribute
    {
        return Attribute::make(
            get: fn (): string => sprintf(
                '%s ➔ %s',
                $this->originStatus?->name ?? 'N/A',
                $this->destinationStatus?->name ?? 'N/A'
            )
        );
    }

    /**
     * Retorna o tempo decorrido em formato amigável.
     */
    protected function timeAgo(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->created_at?->diffForHumans() ?? ''
        );
    }
}
