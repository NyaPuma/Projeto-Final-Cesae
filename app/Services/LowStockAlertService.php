<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Part;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Detects parts with low stock and triggers in-app notifications.
 *
 * Used by the scheduled CheckLowStockJob to avoid calculation on every request.
 */
final class LowStockAlertService
{
    public function __construct(
        private readonly NotificationCreatorService $notificationCreatorService,
    ) {}

    /**
     * Returns parts in alert state, sorted by criticality
     * (current_stock / min_stock ratio).
     *
     * @return array<int, Part>
     */
    public function partsInAlert(): array
    {
        return Part::query()
            ->with(['category', 'taxRate'])
            ->lowStock()
            ->orderByRaw('CASE WHEN min_stock = 0 THEN 0 ELSE current_stock * 1.0 / min_stock END ASC')
            ->get()
            ->all();
    }

    /**
     * Creates an in-app notification for each alert part to all admins.
     *
     * @return int number of notifications created
     */
    public function notifyAdminsForLowStock(): int
    {
        $parts = $this->partsInAlert();

        if ($parts === []) {
            return 0;
        }

        $created = 0;

        foreach ($parts as $part) {
            try {
                $this->notificationCreatorService->createForAdmins(
                    title: __('stock.Low Stock'),
                    message: __('stock.:part — current stock :current (minimum :min)', [
                        'part' => $part->name,
                        'current' => $part->current_stock,
                        'min' => $part->min_stock,
                    ]),
                    type: NotificationTypeEnum::LowStock->value,
                    link: route('ui.stock.parts.show', $part),
                );

                $created++;
            } catch (Throwable $e) {
                Log::warning('Failed to notify low stock', [
                    'part_id' => $part->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $created;
    }
}
