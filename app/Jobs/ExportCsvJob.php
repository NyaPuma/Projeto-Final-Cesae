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
     * The maximum number of attempts before the job fails.
     */
    public int $tries = 3;

    /**
     * The maximum number of seconds the job may run.
     */
    public int $timeout = 120;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function handle(AnalyticsService $analyticsService): void
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.csv';

        // Ensure the destination directory exists on the configured disk
        Storage::disk('public')->makeDirectory('exports');

        $path = Storage::disk('public')->path('exports/'.$filename);

        $analyticsService->exportCsvToFile($path);

        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Exportação CSV concluída',
            'message' => "O ficheiro {$filename} está pronto para download.",
            'type' => 'system',
            'is_read' => false,
            'link' => '/storage/exports/'.$filename,
        ]);
    }

    /**
     * Notifies the user when a fatal error occurs during file generation.
     */
    public function failed(?Throwable $exception): void
    {
        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Falha na exportação CSV',
            'message' => 'Não foi possível gerar o relatório pretendido. Por favor, tente novamente.',
            'type' => 'system',
            'is_read' => false,
            'link' => null,
        ]);
    }
}
