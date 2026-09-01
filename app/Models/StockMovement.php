<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StockMovementTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;

final class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'ticket_id',
        'equipment_id',
        'user_id',
        'movement_type',
        'quantity',
        'reason',
        'unit_price_snapshot',
        'stock_after',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'stock_after' => 'integer',
            'unit_price_snapshot' => 'decimal:2',
        ];
    }

    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate effective stock quantity delta applied by this movement.
     */
    public function delta(): int
    {
        return match ((string) $this->getAttribute('movement_type')) {
            StockMovementTypeEnum::In->value,
            StockMovementTypeEnum::Return->value => abs((int) $this->quantity),
            StockMovementTypeEnum::Out->value => -abs((int) $this->quantity),
            StockMovementTypeEnum::Adjust->value => (int) $this->quantity,
            default => throw new InvalidArgumentException("Invalid movement type: {$this->movement_type}"),
        };
    }
}
