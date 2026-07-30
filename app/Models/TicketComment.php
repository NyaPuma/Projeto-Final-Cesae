<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TicketComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'parent_id',
        'comment',
        'is_internal',
        'edited_at',
    ];

    protected function casts(): array
    {
        return [
            'is_internal' => 'boolean',
            'edited_at' => 'datetime',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // --- SCOPES ---

    /**
     * Scope para ordenar os comentários cronologicamente (do mais antigo para o mais recente).
     */
    public function scopeChronological(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'asc');
    }

    // --- ACCESSORS ---

    /**
     * Retorna o tempo decorrido desde a criação em formato relativo (ex: "há 5 minutos").
     */
    protected function timeAgo(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->created_at?->diffForHumans() ?? ''
        );
    }

    /**
     * Indica se o comentário foi editado após a sua publicação.
     */
    protected function isEdited(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->updated_at && $this->created_at && $this->updated_at->gt($this->created_at)
        );
    }
}
