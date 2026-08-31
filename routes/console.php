<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Preventive Telemetry Scheduling
|--------------------------------------------------------------------------
| The telemetry:simulate command runs automatically every hour,
| checking for equipment anomalies and creating maintenance tickets.
| To activate, ensure the Laravel cron is configured:
|   * * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
*/
Schedule::command('telemetry:simulate --equipments=5 --probability=25')
    ->hourly()
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/telemetry.log'));

/*
|--------------------------------------------------------------------------
| Database Backup Scheduling
|--------------------------------------------------------------------------
| Creates a daily MySQL database backup with 30-day retention.
| Gzip compression is controlled by DB_BACKUP_COMPRESSION (config) and
| retention by DB_BACKUP_RETENTION_DAYS; the --clean option removes backups
| older than the retention period.
*/
Schedule::command('db:backup --clean')
    ->daily()
    ->at('02:00')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/backup.log'));

/*
|--------------------------------------------------------------------------
| Audit Partition Scheduling
|--------------------------------------------------------------------------
| Creates monthly partitions for the audit table.
*/
Schedule::command('audit:partition --months=12')
    ->monthly()
    ->appendOutputTo(storage_path('logs/audit_partitions.log'));

/*
|--------------------------------------------------------------------------
| Currency Exchange Rates Scheduling
|--------------------------------------------------------------------------
| The currency:update-rates command runs twice a day, keeping the exchange
| conversions stored in `currency_rates` reasonably fresh for per-user
| currency preferences.
*/
Schedule::command('currency:update-rates')
    ->twiceDaily()
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/currency_rates.log'));
