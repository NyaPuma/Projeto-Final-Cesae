<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use LogicException;

final class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'auditable_type',
        'auditable_id',
        'event',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
    ];

    /**
     * Mapeamento de tipos dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    /**
     * Bloqueia qualquer tentativa de UPDATE ou DELETE ao nível dos eventos do Eloquent.
     */
    protected static function booted(): void
    {
        static::updating(static function (): void {
            throw new LogicException('Audit records are immutable and cannot be updated.');
        });

        static::deleting(static function (): void {
            throw new LogicException('Audit records are immutable and cannot be deleted.');
        });
    }

    /**
     * Utilizador que realizou a ação auditada.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Modelo polimórfico auditado (ex: Ticket, User, Budget, etc.).
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}