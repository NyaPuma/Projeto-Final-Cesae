<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\LowStockAlertService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Checks for low-stock parts daily and triggers admin alerts.
 *
 * Scheduled in the scheduler (bootstrap/app.php) to avoid calculation on every request.
 */
final class CheckLowStockJob implements ShouldQueue
{
    use Queueable;

    public function handle(LowStockAlertService $alertService): void
    {
        try {
            $created = $alertService->notifyAdminsForLowStock();

            Log::info('CheckLowStockJob completed', [
                'notifications_created' => $created,
            ]);
        } catch (Throwable $e) {
            Log::error('CheckLowStockJob failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
