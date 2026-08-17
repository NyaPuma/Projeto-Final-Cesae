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

final class ExportPdfJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * O número de vezes que o job pode ser tentado antes de falhar.
     */
    public int $tries = 2;

    /**
     * O número máximo de segundos que o job pode executar.
     */
    public int $timeout = 180;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function handle(AnalyticsService $analyticsService): void
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.pdf';

        // Garante que o diretório 'exports' existe no disco configurado
        Storage::disk('public')->makeDirectory('exports');

        $path = Storage::disk('public')->path('exports/'.$filename);

        $analyticsService->exportPdfToFile($path);

        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Exportação PDF concluída',
            'message' => "O ficheiro {$filename} está pronto para download.",
            'type' => 'system',
            'is_read' => false,
            'link' => '/storage/exports/'.$filename,
        ]);
    }

    /**
     * Notifica o utilizador caso ocorra uma falha durante a renderização do PDF.
     */
    public function failed(?Throwable $exception): void
    {
        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Falha na exportação PDF',
            'message' => 'Não foi possível gerar o relatório em PDF. Por favor, tente novamente.',
            'type' => 'system',
            'is_read' => false,
            'link' => null,
        ]);
    }
}
