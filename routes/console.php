<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Agendamento de Telemetria Preventiva
|--------------------------------------------------------------------------
| O comando telemetry:simulate executa automaticamente a cada hora,
| verificando anomalias nos equipamentos e criando tickets de manutenção.
| Para ativar, certifique-se de que o cron do Laravel está configurado:
|   * * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
*/
Schedule::command('telemetry:simulate --equipments=5 --probability=25')
    ->hourly()
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/telemetry.log'));

/*
|--------------------------------------------------------------------------
| Agendamento de Backup de Base de Dados
|--------------------------------------------------------------------------
| Cria um backup diário da base de dados MySQL com retenção de 30 dias.
*/
Schedule::command('db:backup --compress --retention=30')
    ->daily()
    ->at('02:00')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/backup.log'));

/*
|--------------------------------------------------------------------------
| Agendamento de Partições de Auditoria
|--------------------------------------------------------------------------
| Regista partições mensais para a tabela de auditorias.
*/
Schedule::command('audit:partition --months=12')
    ->monthly()
    ->appendOutputTo(storage_path('logs/audit_partitions.log'));
