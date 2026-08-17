<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\LowStockAlertService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Verifica diariamente as peças com stock baixo e dispara alertas.
 *
 * Agendado no scheduler (bootstrap/app.php) — evita cálculo a cada pedido.
 */
final class CheckLowStockJob implements ShouldQueue
{
    use Queueable;

    public function handle(LowStockAlertService $alertService): void
    {
        try {
            $created = $alertService->notifyAdminsForLowStock();

            Log::info('CheckLowStockJob concluído', [
                'notifications_created' => $created,
            ]);
        } catch (Throwable $e) {
            Log::error('Falha no CheckLowStockJob', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
