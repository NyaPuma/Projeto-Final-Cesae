<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\CurrencyRateService;
use Illuminate\Console\Command;

/**
 * Fetches the latest currency exchange rates from the ECB-backed Frankfurter
 * API and stores them in the `currency_rates` table. Scheduled twice per day
 * in `routes/console.php` so local currency conversions stay reasonably fresh.
 */
final class UpdateCurrencyRates extends Command
{
    protected $signature = 'currency:update-rates';

    protected $description = 'Fetches the latest exchange rates and stores them in the database.';

    public function handle(CurrencyRateService $currencyService): int
    {
        $this->info('A atualizar taxas de câmbio...');

        $stored = $currencyService->updateRates();

        if ($stored === 0) {
            $this->error('Não foi possível obter taxas de câmbio do fornecedor.');

            return self::FAILURE;
        }

        $this->info("Taxas de câmbio atualizadas: {$stored} pares de moedas armazenados.");

        return self::SUCCESS;
    }
}
