<?php

namespace App\Models;

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

    // Nomes esperados na tabela `ticket_statuses`
    public const STATUS_OPEN = 'aberta';

    public const STATUS_IN_PROGRESS = 'em curso';

    public const STATUS_CLOSED = 'fechada';

    public const STATUS_CANCELLED = 'fechada';

    public const STATUS_PENDING_BUDGET = 'aberta';

    public const STATUS_REJECTED = 'fechada';

    // Prioridades de avaria
    public const PRIORITY_LOW = 'baixa';

    public const PRIORITY_MEDIUM = 'média';

    public const PRIORITY_HIGH = 'alta';
    public const PRIORITY_CRITICAL = 'crítica';

    // Estados do Orçamento
    public const BUDGET_PENDING = 'pending';

    public const BUDGET_APPROVED = 'approved';

    public const BUDGET_REJECTED = 'rejected';

    protected $guarded = [];

    protected $casts = [
        'opened_at' => 'datetime',
        'in_progress_at' => 'datetime',
        'closed_at' => 'datetime',
        'reopened_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'scheduled_end' => 'datetime',
        'budget_requested_at' => 'datetime', // 🟢 CORRIGIDO: Garante uso de objetos Carbon/DateTime para o SLA
        'budget_decided_at' => 'datetime', // 🟢 CORRIGIDO: Garante uso de objetos Carbon/DateTime para o SLA
        'scheduled' => 'boolean',
        'budget_requested' => 'boolean',
        'cost' => 'decimal:2',
        'budget_amount' => 'decimal:2',
        'budget_details' => 'json', // Orçamento detalhado (array de itens)
    ];

    // --- RELACIONAMENTOS ELOQUENT ---

    /**
     * @return BelongsTo<TicketStatus, $this>
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function budgetApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'budget_approved_by');
    }

    public function workflowHistory(): HasMany
    {
        return $this->hasMany(TicketWorkflowHistory::class, 'ticket_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * @return BelongsTo<Equipment, $this>
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * @return BelongsTo<Room, $this>
     */
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

    // --- LÓGICA DE NEGÓCIO E WORKFLOW ---

    public function startRepair(): bool
    {
        $statusInProgress = TicketStatus::where('name', self::STATUS_IN_PROGRESS)->first();

        if (! $statusInProgress) {
            return false;
        }

        $this->status_id = $statusInProgress->id;
        $this->in_progress_at = now();

        return $this->save();
    }

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
        if (! $this->hasStatus(self::STATUS_CLOSED)) {
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
     * Congela/Regista o timestamp para permitir a pausa do SLA nos relatórios de Analytics.
     */
    public function requestBudgetAuthorization(float $estimatedBudget, float $threshold): bool
    {
        if ($estimatedBudget > $threshold) {
            $this->budget_requested = true;
            $this->budget_status = self::BUDGET_PENDING;
            $this->budget_amount = $estimatedBudget;
            $this->budget_requested_at = now(); // Regista início do congelamento do SLA

            $pendingStatusId = self::getStatusIdByName(self::STATUS_PENDING_BUDGET);
            if ($pendingStatusId) {
                $this->status_id = $pendingStatusId;
            }

            return $this->save();
        }

        return false;
    }

    /**
     * Executado exclusivamente pelo Administrador para aprovar ou rejeitar o orçamento.
     */
    public function approveBudget(User $admin, string $decision = 'approve', ?string $feedback = null): bool
    {
        if (! $admin->isAdmin()) {
            return false;
        }

        $this->budget_approved_by = $admin->id;
        $this->budget_decided_at = now(); // Regista fim da pausa do SLA

        if ($decision === 'reject') {
            $this->budget_status = self::BUDGET_REJECTED;

            $rejectedStatusId = self::getStatusIdByName(self::STATUS_REJECTED);
            if ($rejectedStatusId) {
                $this->status_id = $rejectedStatusId;
            }

            if (! empty($feedback)) {
                $this->budget_feedback = $feedback;
            }

            return $this->save();
        }

        // Caso Aprovado
        $this->budget_status = self::BUDGET_APPROVED;

        $inProgressStatusId = self::getStatusIdByName(self::STATUS_IN_PROGRESS);
        if ($inProgressStatusId) {
            $this->status_id = $inProgressStatusId;
        }

        return $this->save();
    }

    /**
     * Helper de Negócio: Calcula o tempo morto (em minutos) em que o ticket esteve parado a aguardar decisão orçamental.
     */
    public function getBudgetPauseMinutesAttribute(): int
    {
        if ($this->budget_requested_at && $this->budget_decided_at) {
            return (int) $this->budget_requested_at->diffInMinutes($this->budget_decided_at);
        }

        return 0;
    }

    // --- CAMPOS DE MÃO DE OBRA ---

    /**
     * Calcula o custo total de materiais a partir do budget_details (JSON).
     * Material: quantity × unit_price
     */
    public function getTotalMaterialCostAttribute(): float
    {
        return $this->calculateBudgetTotalByType('material');
    }

    /**
     * Calcula o custo total de mão de obra a partir do budget_details (JSON).
     * Labor: hours × hourly_rate
     */
    public function getTotalLaborCostAttribute(): float
    {
        return $this->calculateBudgetTotalByType('labor');
    }

    /**
     * Calcula o custo total do orçamento (materiais + mão de obra).
     */
    public function getBudgetTotalAttribute(): float
    {
        return $this->total_material_cost + $this->total_labor_cost;
    }

    /**
     * Retorna um array com breakdown material vs labor.
     */
    public function getBudgetBreakdownAttribute(): array
    {
        $materialItems = [];
        $laborItems = [];
        $details = $this->budget_details ?? [];

        foreach ($details as $item) {
            $type = $item['type'] ?? 'material';
            if ($type === 'labor') {
                $subtotal = ($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0);
                $laborItems[] = array_merge($item, ['subtotal' => $subtotal]);
            } else {
                $subtotal = ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                $materialItems[] = array_merge($item, ['subtotal' => $subtotal]);
            }
        }

        return [
            'materials' => $materialItems,
            'labor' => $laborItems,
            'material_total' => collect($materialItems)->sum('subtotal'),
            'labor_total' => collect($laborItems)->sum('subtotal'),
            'grand_total' => collect($materialItems)->sum('subtotal') + collect($laborItems)->sum('subtotal'),
        ];
    }

    /**
     * Método privado auxiliar para calcular total por tipo.
     */
    private function calculateBudgetTotalByType(string $type): float
    {
        $details = $this->budget_details ?? [];
        $total = 0;

        foreach ($details as $item) {
            $itemType = $item['type'] ?? 'material';
            if ($itemType === $type) {
                if ($type === 'labor') {
                    $total += ($item['hours'] ?? 0) * ($item['hourly_rate'] ?? 0);
                } else {
                    $total += ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                }
            }
        }

        return $total;
    }

    // --- MÉTODOS UTILITÁRIOS E AUXILIARES  ---

    /**
     * Obtém o ID do status pelo nome na tabela `ticket_statuses`.
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
        if (! $this->status_id) {
            return false;
        }

        $statusId = self::getStatusIdByName($statusName);

        return $this->status_id === $statusId;
    }

    /**
     * Obtém o técnico com menos tickets atribuídos no momento.
     */
    public static function getLeastBusyTechnician(): ?User
    {
        $inProgressStatusId = self::getStatusIdByName(self::STATUS_IN_PROGRESS);

        return User::whereHas('profile', function ($query) {
            $query->where('name', User::ROLE_TECHNICIAN);
        })
            ->where('active', true)
            ->withCount(['assignedTickets' => function ($query) use ($inProgressStatusId) {
                $query->where('status_id', $inProgressStatusId);
            }])
            ->orderBy('assigned_tickets_count', 'asc')
            ->first();
    }

    /**
     * Atalho de segurança para recolher eventos agendados para o FullCalendar.
     */
    public static function getScheduledEvents()
    {
        return self::whereNotNull('scheduled_at')->get()->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'title' => '🔧 #'.$ticket->id.' - '.$ticket->title,
                'start' => $ticket->scheduled_at ? $ticket->scheduled_at->toIso8601String() : null,
                'end' => $ticket->scheduled_end ? $ticket->scheduled_end->toIso8601String() : null,
            ];
        });
    }
}
