<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class TicketWorkflowHistory extends Model
{
    use HasFactory;

    protected $table = 'ticket_workflow_history';

    protected $fillable = [
        'ticket_id',
        'origin_status_id',
        'destination_status_id',
        'technician_id',
        'comment',
    ];

    // --- RELATIONSHIPS ---

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function originStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'origin_status_id');
    }

    public function destinationStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'destination_status_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    // --- SCOPES ---

    /**
     * Scope to order workflow history descending chronologically.
     */
    public function scopeChronological(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    // --- ACCESSORS ---

    /**
     * Text representation of the status transition (e.g. "Open ➔ In Progress").
     */
    protected function transitionLabel(): Attribute
    {
        return Attribute::make(
            get: fn (): string => sprintf(
                '%s ➔ %s',
                $this->originStatus?->name ?? 'N/A',
                $this->destinationStatus?->name ?? 'N/A'
            )
        );
    }

    /**
     * Relative time string.
     */
    protected function timeAgo(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->created_at?->diffForHumans() ?? ''
        );
    }
}
