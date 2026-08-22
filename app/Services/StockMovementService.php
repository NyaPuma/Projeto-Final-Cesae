<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StockMovementTypeEnum;
use App\Models\Part;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

/**
 * Centralizes all part stock changes.
 *
 * Business rule: any change to `current_stock` must go through a record in
 * `stock_movements`, within a transaction, ensuring full traceability and atomicity.
 */
final class StockMovementService
{
    /**
     * Records a movement and updates part stock atomically.
     *
     * @param  int  $quantity  quantity (positive for in/return, negative for out,
     *                         signed for adjust — any value accepted)
     * @param  User|null  $user  user recording the movement
     */
    public function record(
        Part $part,
        StockMovementTypeEnum $movementType,
        int $quantity,
        ?string $reason = null,
        ?int $ticketId = null,
        ?int $equipmentId = null,
        ?User $user = null,
        ?float $unitPriceSnapshot = null,
    ): StockMovement {
        if ($quantity === 0) {
            throw new InvalidArgumentException('A movement quantity cannot be zero.');
        }

        return DB::transaction(function () use ($part, $movementType, $quantity, $reason, $ticketId, $equipmentId, $user, $unitPriceSnapshot) {
            $locked = Part::query()->lockForUpdate()->find($part->id);

            if ($locked === null) {
                throw new RuntimeException("Part '{$part->sku}' not found.");
            }

            $delta = $this->delta($movementType, $quantity);

            $newStock = $locked->current_stock + $delta;

            if ($newStock < 0) {
                throw new InvalidArgumentException(
                    "Insufficient stock: the movement would leave part '{$locked->sku}' with negative stock."
                );
            }

            $snapshot = $unitPriceSnapshot
                ?? (float) $locked->cost_price;

            $locked->update([
                'current_stock' => $newStock,
            ]);

            return StockMovement::create([
                'part_id' => $locked->id,
                'ticket_id' => $ticketId,
                'equipment_id' => $equipmentId,
                'user_id' => $user?->id,
                'movement_type' => $movementType->value,
                'quantity' => $quantity,
                'reason' => $reason ? trim($reason) : null,
                'unit_price_snapshot' => $snapshot,
                'stock_after' => $newStock,
            ]);
        });
    }

    /**
     * Calculates stock delta based on movement type.
     */
    private function delta(StockMovementTypeEnum $type, int $quantity): int
    {
        return match ($type) {
            StockMovementTypeEnum::In,
            StockMovementTypeEnum::Return => abs($quantity),
            StockMovementTypeEnum::Out => -abs($quantity),
            StockMovementTypeEnum::Adjust => $quantity,
        };
    }
}
