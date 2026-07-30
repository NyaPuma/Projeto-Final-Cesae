<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TicketType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (TicketType $type) {
            if ($type->code === null) {
                $type->code = strtoupper(uniqid('TYPE_'));
            }
        });
    }

    protected $fillable = [
        'code',
        'name',
        'description',
        'notes',
        'active',
    ];

    // --- RELAÇÕES ---

    /**
     * Estados de fluxo de trabalho associados a este tipo de avaria.
     * Manteve-se 'type_id' explicitamente para coincidir com a coluna da tabela 'ticket_statuses'.
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(TicketStatus::class, 'type_id');
    }

    /**
     * Obtém diretamente todos os chamados/tickets deste tipo através dos seus estados.
     */
    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(
            Ticket::class,
            TicketStatus::class,
            'type_id',   // Chave estrangeira na tabela 'ticket_statuses'
            'status_id'  // Chave estrangeira na tabela 'tickets'
        );
    }
}
