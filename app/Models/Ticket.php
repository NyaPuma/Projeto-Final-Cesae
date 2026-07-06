<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Equipment;
use App\Models\Room;

class Ticket extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'aberta';
    public const STATUS_IN_PROGRESS = 'em curso';
    public const STATUS_CLOSED = 'fechada';

    protected $fillable = [
        'user_id',
        'assigned_to',
        'equipment_id',
        'room_id',
        'title',
        'description',
        'status',
        'opened_at',
        'in_progress_at',
        'closed_at',
        'minutes_spent',
        'cost',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'in_progress_at' => 'datetime',
        'closed_at' => 'datetime',
        'minutes_spent' => 'integer',
        'cost' => 'decimal:2',
    ];

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
}
