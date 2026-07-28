<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    /** @var list<string> */
    protected $fillable = [
        'title', 'description', 'priority', 'user_id', 'assigned_to',
        'equipment_id', 'room_id', 'status_id', 'custo_estimado',
        'orcamento_aprovado', 'opened_at', 'in_progress_at', 'closed_at',
        'reopened_at', 'cost', 'minutes_spent', 'technical_report',
        'budget_requested', 'budget_status', 'budget_amount',
        'budget_requested_at', 'budget_approved_by', 'budget_decided_at',
        'budget_feedback', 'budget_details', 'scheduled_at', 'scheduled_end',
        'scheduled',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'opened_at' => 'datetime',
        'in_progress_at' => 'datetime',
        'closed_at' => 'datetime',
        'reopened_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'scheduled_end' => 'datetime',
        'budget_requested_at' => 'datetime',
        'budget_decided_at' => 'datetime',
        'scheduled' => 'boolean',
        'budget_requested' => 'boolean',
        'orcamento_aprovado' => 'boolean',
        'cost' => 'decimal:2',
        'budget_amount' => 'decimal:2',
        'custo_estimado' => 'decimal:2',
        'budget_details' => 'json',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function budgetApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'budget_approved_by');
    }

    public function workflowHistory(): HasMany
    {
        return $this->hasMany(TicketWorkflowHistory::class, 'ticket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class);
    }

    public function scopeOpen($query)
    {
        $statusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        return $query->where('status_id', $statusId);
    }

    public function scopeForTechnician($query, int $technicianId)
    {
        return $query->where('assigned_to', $technicianId);
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
