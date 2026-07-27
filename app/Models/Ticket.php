<?php

namespace App\Models;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Services\BudgetCalculatorService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketStatusService;
use App\Services\TicketWorkflowService;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Ticket extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public const STATUS_OPEN = 'aberta';

    public const STATUS_IN_PROGRESS = 'em curso';

    public const STATUS_CLOSED = 'fechada';

    public const STATUS_CANCELLED = 'cancelada';

    public const STATUS_PENDING_BUDGET = 'pendente orçamento';

    public const STATUS_REJECTED = 'recusada';

    public const PRIORITY_LOW = 'baixa';

    public const PRIORITY_MEDIUM = 'média';

    public const PRIORITY_HIGH = 'alta';

    public const PRIORITY_CRITICAL = 'crítica';

    public const BUDGET_PENDING = 'pending';

    public const BUDGET_APPROVED = 'approved';

    public const BUDGET_REJECTED = 'rejected';

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

    // --- Relationships ---

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

    // --- Workflow helpers (delegated to services) ---

    public function hasStatus(TicketStatusEnum $status): bool
    {
        if (! $this->status_id) {
            return false;
        }

        $statusId = app(TicketStatusService::class)->getByName($status);

        return $this->status_id === $statusId;
    }

    public function startRepair(): bool
    {
        return app(TicketWorkflowService::class)->startRepair($this);
    }

    public function reopen(): bool
    {
        return app(TicketWorkflowService::class)->reopen($this);
    }

    public function approveBudget(User $admin, string $decision = 'approve', ?string $feedback = null): bool
    {
        if (! $admin->isAdmin()) {
            return false;
        }

        $this->budget_approved_by = $admin->id;
        $this->budget_decided_at = now();

        if ($decision === 'reject') {
            $this->budget_status = self::BUDGET_REJECTED;
            $rejectedStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Rejected);
            if ($rejectedStatusId) {
                $this->status_id = $rejectedStatusId;
            }
            if (! empty($feedback)) {
                $this->budget_feedback = $feedback;
            }

            return $this->save();
        }

        $this->budget_status = self::BUDGET_APPROVED;
        $inProgressStatusId = app(TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);
        if ($inProgressStatusId) {
            $this->status_id = $inProgressStatusId;
        }

        return $this->save();
    }

    // --- Budget Accessors ---

    public function getBudgetPauseMinutesAttribute(): int
    {
        if ($this->budget_requested_at && $this->budget_decided_at) {
            return (int) $this->budget_requested_at->diffInMinutes($this->budget_decided_at);
        }

        return 0;
    }

    public function getTotalMaterialCostAttribute(): float
    {
        return app(BudgetCalculatorService::class)->calculateTotalMaterialCost($this);
    }

    public function getTotalLaborCostAttribute(): float
    {
        return app(BudgetCalculatorService::class)->calculateTotalLaborCost($this);
    }

    public function getBudgetTotalAttribute(): float
    {
        return app(BudgetCalculatorService::class)->calculateBudgetTotal($this);
    }

    public function getBudgetBreakdownAttribute(): array
    {
        return app(BudgetCalculatorService::class)->getBreakdown($this);
    }

    // --- Scopes ---

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

    // --- Static helpers (kept for backward compatibility, delegates to services) ---

    public static function getStatusIdByName(string $statusName): ?int
    {
        $enum = TicketStatusEnum::fromValue($statusName);

        if ($enum) {
            return app(TicketStatusService::class)->getByName($enum);
        }

        $cached = Cache::get("ticket_status:{$statusName}");

        if ($cached !== null) {
            return $cached;
        }

        $id = TicketStatus::where('name', $statusName)->value('id');

        if ($id !== null) {
            Cache::put("ticket_status:{$statusName}", $id, 3600);
        }

        return $id;
    }

    public static function flushStatusCache(): void
    {
        app(TicketStatusService::class)->flush();
    }

    public static function getLeastBusyTechnician(): ?User
    {
        return app(TechnicianAssignmentService::class)->getLeastBusyTechnician();
    }

    public static function getScheduledEvents(?string $from = null, ?string $to = null): Collection
    {
        $query = self::whereNotNull('scheduled_at')
            ->select('id', 'title', 'scheduled_at', 'scheduled_end');

        if ($from) {
            $query->where('scheduled_at', '>=', $from);
        }

        if ($to) {
            $query->where('scheduled_at', '<=', $to);
        }

        return $query->get()->map(fn ($ticket) => [
            'id' => $ticket->id,
            'title' => '🔧 #'.$ticket->id.' - '.$ticket->title,
            'start' => $ticket->scheduled_at->toIso8601String(),
            'end' => $ticket->scheduled_end?->toIso8601String(),
        ]);
    }
}
