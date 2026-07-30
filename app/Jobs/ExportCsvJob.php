<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Notification;
use App\Services\AnalyticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class ExportCsvJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * O número de vezes que o job pode ser tentado antes de falhar.
     */
    public int $tries = 3;

    /**
     * O número máximo de segundos que o job pode executar.
     */
    public int $timeout = 120;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function handle(AnalyticsService $analyticsService): void
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.csv';

        // Garante que a pasta de destino existe no disco configurado
        Storage::disk('local')->makeDirectory('exports');

        $path = Storage::disk('local')->path('exports/'.$filename);

        $analyticsService->exportCsvToFile($path);

        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Exportação CSV concluída',
            'message' => "O ficheiro {$filename} está pronto para download.",
            'type' => 'export',
            'is_read' => false,
            'link' => '/storage/exports/'.$filename,
        ]);
    }

    /**
     * Notifica o utilizador caso ocorra um erro fatal na geração do ficheiro.
     */
    public function failed(?Throwable $exception): void
    {
        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Falha na exportação CSV',
            'message' => 'Não foi possível gerar o relatório pretendido. Por favor, tente novamente.',
            'type' => 'export_error',
            'is_read' => false,
            'link' => null,
        ]);
    }
}
