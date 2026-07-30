<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'priority',
        'is_read',
        'read_at',
        'link',
        'notifiable_type',
        'notifiable_id',
        'data',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'expires_at' => 'datetime',
            'data' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope para filtrar apenas notificações não lidas.
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope para filtrar apenas notificações já lidas.
     */
    public function scopeRead(Builder $query): Builder
    {
        return $query->where('is_read', true);
    }

    /**
     * Marca a notificação como lida.
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }

    /**
     * Marca a notificação como não lida.
     */
    public function markAsUnread(): bool
    {
        return $this->update(['is_read' => false]);
    }
}
