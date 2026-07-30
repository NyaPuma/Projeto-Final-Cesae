<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'auditable_type', 'auditable_id', 'event', 'old_values', 'new_values', 'url', 'ip_address', 'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Audit records are append-only: UPDATE is forbidden at the Eloquent level.
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        throw new \LogicException('Audit records are immutable and cannot be updated.');
    }

    /**
     * Audit records are append-only: DELETE is forbidden at the Eloquent level.
     */
    public function delete(): bool
    {
        throw new \LogicException('Audit records are immutable and cannot be deleted.');
    }
}
