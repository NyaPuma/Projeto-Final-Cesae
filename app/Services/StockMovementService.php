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
 * Centraliza toda a alteração de stock de peças.
 *
 * Regra de negócio: qualquer alteração a `current_stock` passa obrigatoriamente
 * por um registo em `stock_movements`, dentro de uma transação, garantindo
 * rastreabilidade total e atomicidade.
 */
final class StockMovementService
{
    /**
     * Regista um movimento e atualiza o stock da peça de forma atómica.
     *
     * @param  int  $quantity  quantidade (positiva para in/return, negativa para out,
     *                         com sinal para adjust — aceita-se qualquer valor)
     * @param  User|null  $user  utilizador que regista o movimento
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
            throw new InvalidArgumentException('A quantidade de um movimento não pode ser zero.');
        }

        return DB::transaction(function () use ($part, $movementType, $quantity, $reason, $ticketId, $equipmentId, $user, $unitPriceSnapshot) {
            $locked = Part::query()->lockForUpdate()->find($part->id);

            if ($locked === null) {
                throw new RuntimeException("A peça '{$part->sku}' não foi encontrada.");
            }

            $delta = $this->delta($movementType, $quantity);

            $newStock = $locked->current_stock + $delta;

            if ($newStock < 0) {
                throw new InvalidArgumentException(
                    "Stock insuficiente: o movimento deixaria a peça '{$locked->sku}' com stock negativo."
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
     * Calcula a variação de stock consoante o tipo de movimento.
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
