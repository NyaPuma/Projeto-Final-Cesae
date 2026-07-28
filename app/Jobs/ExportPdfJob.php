<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Services\AnalyticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportPdfJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function handle(AnalyticsService $analyticsService): void
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.pdf';
        $path = storage_path('app/exports/'.$filename);

        $analyticsService->exportPdfToFile($path);

        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Exportação PDF concluída',
            'message' => "O ficheiro {$filename} está pronto para download.",
            'type' => 'export',
            'is_read' => false,
            'link' => '/storage/exports/'.$filename,
        ]);
    }
}
