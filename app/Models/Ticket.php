<?php

namespace App\Models;

use App\Domain\Ticket\Services\TicketStatusChecker;
use App\Domain\Ticket\ValueObjects\BudgetPauseMinutes;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
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
    /** @deprecated Use TicketStatusEnum::Open->value */
    public const STATUS_OPEN = 'aberta';

    /** @deprecated Use TicketStatusEnum::InProgress->value */
    public const STATUS_IN_PROGRESS = 'em curso';

    /** @deprecated Use TicketStatusEnum::Closed->value */
    public const STATUS_CLOSED = 'fechada';

    /** @deprecated Use TicketStatusEnum::Cancelled->value */
    public const STATUS_CANCELLED = 'cancelada';

    /** @deprecated Use TicketStatusEnum::PendingBudget->value */
    public const STATUS_PENDING_BUDGET = 'pendente orçamento';

    /** @deprecated Use TicketStatusEnum::Rejected->value */
    public const STATUS_REJECTED = 'recusada';

    /** @deprecated Use TicketPriorityEnum::Low->value */
    public const PRIORITY_LOW = 'baixa';

    /** @deprecated Use TicketPriorityEnum::Medium->value */
    public const PRIORITY_MEDIUM = 'média';

    /** @deprecated Use TicketPriorityEnum::High->value */
    public const PRIORITY_HIGH = 'alta';

    /** @deprecated Use TicketPriorityEnum::Critical->value */
    public const PRIORITY_CRITICAL = 'crítica';

    /** @deprecated Use BudgetStatusEnum::Pending->value */
    public const BUDGET_PENDING = 'pending';

    /** @deprecated Use BudgetStatusEnum::Approved->value */
    public const BUDGET_APPROVED = 'approved';

    /** @deprecated Use BudgetStatusEnum::Rejected->value */
    public const BUDGET_REJECTED = 'rejected';

    /** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */
    public static function flushStatusCache(): void
    {
        app(TicketStatusService::class)->flush();
    }

    /** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */
    public static function getStatusIdByName(string $statusName): ?int
    {
        $enum = TicketStatusEnum::tryFrom($statusName);

        if ($enum) {
            return app(TicketStatusService::class)->getByName($enum);
        }

        return TicketStatus::where('name', $statusName)->value('id');
    }

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

    public function hasStatus(TicketStatusEnum $status): bool
    {
        return app(TicketStatusChecker::class)->hasStatus($this->status_id, $status);
    }

    public function scopeOpen($query)
    {
        return $query->where('status_id', app(TicketStatusService::class)->getByName(TicketStatusEnum::Open));
    }

    public function scopeInProgress($query)
    {
        return $query->where('status_id', app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress));
    }

    public function scopeClosed($query)
    {
        return $query->where('status_id', app(TicketStatusService::class)->getByName(TicketStatusEnum::Closed));
    }

    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at');
    }

    public function scopeByPriority($query, TicketPriorityEnum $priority)
    {
        return $query->where('priority', $priority->value);
    }

    public function scopeForTechnician($query, int $technicianId)
    {
        return $query->where('assigned_to', $technicianId);
    }

    public function getBudgetPauseMinutesAttribute(): int
    {
        return (new BudgetPauseMinutes($this->budget_requested_at, $this->budget_decided_at))->value();
    }
}
