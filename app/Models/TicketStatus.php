<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TicketStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (TicketStatus $status) {
            if ($status->code === null) {
                $status->code = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '_', $status->name ?? 'status'), 0, 20));
            }
        });
    }

    protected $fillable = [
        'code',
        'name',
        'description',
        'notes',
        'active',
        'type_id',
    ];

    // --- RELAÇÕES ---

    /**
     * Tipo de avaria ao qual este estado pertence.
     * Manteve-se 'type_id' explicitamente para coincidir com a coluna da tabela.
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id');
    }

    /**
     * Chamados/Tickets que se encontram atualmente neste estado.
     * Manteve-se 'status_id' explicitamente para coincidir com a coluna da tabela 'tickets'.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'status_id');
    }
}
