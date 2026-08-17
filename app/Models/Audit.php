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
     * Attribute type casting.
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
     * Prevent UPDATE or DELETE on immutable audit records.
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
     * User who triggered the audited event.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Polymorphic model audited (e.g. Ticket, User, Equipment, etc.).
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}