<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Traits\Auditable;

// --- ADICIONA ESTES IMPORTS QUE FALTAM ---
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\TicketComment;
use App\Models\TicketAttachment;
use App\Models\User;
// ----------------------------------------

class Ticket extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes; 

    // Nomes esperados na tabela `ticket_statuses`
    public const STATUS_OPEN = 'aberta';
    public const STATUS_IN_PROGRESS = 'em curso';
    public const STATUS_CLOSED = 'fechada';
    public const STATUS_CANCELLED = 'cancelada';
    public const STATUS_PENDING_BUDGET = 'pendente orçamento';
    public const STATUS_REJECTED = 'recusada';

    // Prioridades de avaria
    public const PRIORITY_LOW = 'baixa';
    public const PRIORITY_MEDIUM = 'média';
    public const PRIORITY_HIGH = 'alta';

    // Estados do Orçamento
    public const BUDGET_PENDING = 'pending';
    public const BUDGET_APPROVED = 'approved';
    public const BUDGET_REJECTED = 'rejected';

    // --- CORRIGIDO: Removida a barreira do $fillable para os Seeds correrem livremente ---
    protected $guarded = [];

    protected $casts = [
        'opened_at'        => 'datetime',
        'in_progress_at'   => 'datetime',
        'closed_at'        => 'datetime',
        'reopened_at'      => 'datetime',
        'scheduled_at'     => 'datetime',
        'scheduled_end'    => 'datetime',
        'scheduled'        => 'boolean',
        'budget_requested' => 'boolean',
        'cost'             => 'decimal:2',
        'budget_amount'    => 'decimal:2',
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

    /**
     * Inicia a reparação do ticket mudando o estado para 'em curso'.
     */
    public function startRepair(): bool
    {
        $statusInProgress = TicketStatus::where('name', self::STATUS_IN_PROGRESS)->first();

        if (!$statusInProgress) {
            return false;
        }

        $this->status_id = $statusInProgress->id;
        $this->in_progress_at = now();
        return $this->save();
    }

    /**
     * Fecha o ticket se o custo estiver abaixo do limiar.
     */
    public function checkAutoClose(float $threshold): bool
    {
        if ($this->cost === null) {
            return false;
        }

        if ($this->cost <= $threshold) {
            $statusClosed = TicketStatus::where('name', self::STATUS_CLOSED)->first();
            if ($statusClosed) {
                $this->status_id = $statusClosed->id;
            }
            $this->closed_at = now();
            return $this->save();
        }

        return false;
    }

    public function reopen(): bool
    {
        if (!$this->hasStatus(self::STATUS_CLOSED)) {
            return false;
        }

        $openStatus = TicketStatus::where('name', self::STATUS_OPEN)->first();
        if ($openStatus) {
            $this->status_id = $openStatus->id;
        }

        $this->reopened_at = now();
        $this->closed_at = null;

        return $this->save();
    }

    /**
     * Solicitado pelo Técnico quando avalia que o custo estimado supera o limiar da empresa.
     * Separamos o Custo Estimado ($estimatedBudget) do Custo Final ($this->cost).
     */
    public function requestBudgetAuthorization(float $estimatedBudget, float $threshold): bool
    {
        if ($estimatedBudget > $threshold) {
            $this->budget_requested = true;
            $this->budget_status = self::BUDGET_PENDING;
            $this->budget_amount = $estimatedBudget; // Guarda a estimativa do técnico para avaliação do ADM

            $pendingStatus = TicketStatus::where('name', self::STATUS_PENDING_BUDGET)->first();
            if ($pendingStatus) {
                $this->status_id = $pendingStatus->id;
            }

            return $this->save();
        }

        return false;
    }

    public function approveBudget(User $admin, string $decision = 'approve', ?string $feedback = null): bool
    {
        if (!$admin->isAdmin()) {
            return false;
        }

        $this->budget_approved_by = $admin->id;

        if ($decision === 'reject') {
            $this->budget_status = self::BUDGET_REJECTED;
            $this->budget_requested = true;

            $rejectedStatus = TicketStatus::where('name', self::STATUS_REJECTED)->first();
            if ($rejectedStatus) {
                $this->status_id = $rejectedStatus->id;
            }

            if (!empty($feedback)) {
                $this->technical_report = $feedback;
            }

            return $this->save();
        }

        $this->budget_status = self::BUDGET_APPROVED;

        $inProgressStatus = TicketStatus::where('name', self::STATUS_IN_PROGRESS)->first();
        if ($inProgressStatus) {
            $this->status_id = $inProgressStatus->id;
        }

        return $this->save();
    }

    /**
     * Obtém o ID do status pelo nome.
     */
    public static function getStatusIdByName(string $statusName): ?int
    {
        return TicketStatus::where('name', $statusName)->value('id');
    }

    /**
     * Verifica se o ticket está num determinado estado pelo nome.
     */
    public function hasStatus(string $statusName): bool
    {
        if (!$this->status_id) {
            return false;
        }

        $statusId = self::getStatusIdByName($statusName);
        return $this->status_id === $statusId;
    }

    /**
     * Atalho de segurança para recolher eventos agendados para o FullCalendar.
     */
    public static function getScheduledEvents()
    {
        return self::whereNotNull('scheduled_at')->get()->map(function ($ticket) {
            return [
                'id'    => $ticket->id,
                'title' => '🔧 #' . $ticket->id . ' - ' . $ticket->title,
                'start' => $ticket->scheduled_at ? $ticket->scheduled_at->toIso8601String() : null,
                'end'   => $ticket->scheduled_end ? $ticket->scheduled_end->toIso8601String() : null,
            ];
        });
    }
    /**
     * Adiciona isto para resolver o erro de "getLeastBusyTechnician" no Controller
     */
    public static function getLeastBusyTechnician()
    {
        return User::whereHas('profile', fn($q) => $q->where('name', User::ROLE_TECHNICIAN))
            ->where('active', true)
            ->withCount(['assignedTickets' => function($query) {
                $query->whereNotIn('status_id', [3, 4]); // Ignora Fechados/Cancelados
            }])
            ->orderBy('assigned_tickets_count', 'asc')
            ->first();
    }

    /**
     * Adiciona isto para garantir que o reopen() funciona sem erros
     */
    public function reopen(): bool
    {
        // Verifica se o estado atual permite reabertura
        // Assumindo que 3 é fechado
        if ($this->status_id != 3) { 
            return false;
        }

        $openStatus = TicketStatus::where('name', self::STATUS_OPEN)->first();
        if ($openStatus) {
            $this->status_id = $openStatus->id;
            $this->reopened_at = now();
            $this->closed_at = null;
            return $this->save();
        }
        return false;
    }
    
}