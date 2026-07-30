<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Ticket extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (Ticket $ticket) {
            if ($ticket->reference === null) {
                $ticket->reference = 'TKT-' . now()->format('YmdHis') . '-' . strtoupper(substr(uniqid(), -5));
            }
        });
    }

    /** @var list<string> */
    protected $fillable = [
        'title', 'description', 'priority', 'user_id', 'assigned_to',
        'equipment_id', 'room_id', 'status_id', 'reference', 'urgent',
        'opened_at', 'in_progress_at', 'closed_at', 'reopened_at',
        'assigned_at', 'first_response_at', 'resolved_at',
        'minutes_spent', 'technical_report', 'resolution_summary',
        'resolution', 'estimated_minutes', 'estimated_cost', 'actual_cost',
        'resolved_by', 'closed_by',
        'budget_requested', 'budget_status', 'budget_amount',
        'budget_requested_at', 'budget_approved_by', 'budget_decided_at',
        'budget_approved_at', 'budget_feedback', 'budget_details',
        'scheduled_at', 'scheduled_end', 'scheduled',
        'due_at', 'sla_breached',
    ];

    /**
     * Mapeamento de tipos dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'opened_at' => 'datetime',
            'in_progress_at' => 'datetime',
            'closed_at' => 'datetime',
            'reopened_at' => 'datetime',
            'assigned_at' => 'datetime',
            'first_response_at' => 'datetime',
            'resolved_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'scheduled_end' => 'datetime',
            'budget_requested_at' => 'datetime',
            'budget_decided_at' => 'datetime',
            'budget_approved_at' => 'datetime',
            'due_at' => 'datetime',
            'scheduled' => 'boolean',
            'budget_requested' => 'boolean',
            'urgent' => 'boolean',
            'sla_breached' => 'boolean',
            'actual_cost' => 'decimal:2',
            'estimated_cost' => 'decimal:2',
            'budget_amount' => 'decimal:2',
            'estimated_minutes' => 'integer',
            'minutes_spent' => 'integer',
            'budget_details' => 'array',
        ];
    }

    // --- RELAÇÕES ---

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function budgetApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'budget_approved_by');
    }

    public function workflowHistory(): HasMany
    {
        return $this->hasMany(TicketWorkflowHistory::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class);
    }

    // --- SCOPES ---

    public function scopeOpen(Builder $query): Builder
    {
        $statusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        return $query->where('status_id', $statusId);
    }

    public function scopeForTechnician(Builder $query, int $technicianId): Builder
    {
        return $query->where('assigned_to', $technicianId);
    }

    // --- ACCESSORS & HELPER METHODS ---

    /**
     * Accessor moderno para calcular o tempo em minutos de pausa para aprovação de orçamento.
     */
    protected function budgetPauseMinutes(): Attribute
    {
        return Attribute::make(
            get: fn (): int => ($this->budget_requested_at && $this->budget_decided_at)
                ? (int) $this->budget_requested_at->diffInMinutes($this->budget_decided_at)
                : 0
        );
    }

    public function hasStatus(TicketStatusEnum|string $status): bool
    {
        $statusEnum = is_string($status) ? TicketStatusEnum::tryFrom($status) : $status;

        if (! $statusEnum) {
            return false;
        }

        $statusId = app(TicketStatusService::class)->getByName($statusEnum);

        return $this->status_id === $statusId;
    }
}
