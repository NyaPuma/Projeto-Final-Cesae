<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Part;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Deteta peças com stock baixo e dispara notificações in-app.
 *
 * Usado pelo job agendado CheckLowStockJob para evitar cálculo a cada pedido.
 */
final class LowStockAlertService
{
    public function __construct(
        private readonly NotificationCreatorService $notificationCreatorService,
    ) {}

    /**
     * Devolve as peças em estado de alerta, ordenadas por criticidade
     * (razão stock_atual / stock_minimo).
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
     * Cria uma notificação in-app por peça em alerta para todos os admins.
     *
     * @return int número de notificações criadas
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
                    title: __('stock.Stock Baixo'),
                    message: __('stock.:part — stock atual :current (mínimo :min)', [
                        'part' => $part->name,
                        'current' => $part->current_stock,
                        'min' => $part->min_stock,
                    ]),
                    type: NotificationTypeEnum::LowStock->value,
                    link: route('ui.stock.parts.show', $part),
                );

                $created++;
            } catch (Throwable $e) {
                Log::warning('Falha ao notificar stock baixo', [
                    'part_id' => $part->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $created;
    }
}
