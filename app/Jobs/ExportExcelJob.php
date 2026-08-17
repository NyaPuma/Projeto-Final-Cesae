<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Exports\TicketsExport;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

final class ExportExcelJob implements ShouldQueue
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
    public int $timeout = 300;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function handle(): void
    {
        $filename = 'tickets_report_'.now()->format('Ymd_His').'.xlsx';

        // Garante que a pasta de destino existe no disco configurado
        Storage::disk('public')->makeDirectory('exports');

        Excel::store(
            new TicketsExport(),
            'exports/'.$filename,
            'public',
            \Maatwebsite\Excel\Excel::XLSX,
        );

        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Exportação Excel concluída',
            'message' => "O ficheiro {$filename} está pronto para download.",
            'type' => 'system',
            'is_read' => false,
            'link' => '/storage/exports/'.$filename,
        ]);
    }

    /**
     * Notifica o utilizador caso ocorra uma falha fatal na geração do ficheiro.
     */
    public function failed(?Throwable $exception): void
    {
        Notification::create([
            'user_id' => $this->userId,
            'title' => 'Falha na exportação Excel',
            'message' => 'Não foi possível gerar o relatório pretendido. Por favor, tente novamente.',
            'type' => 'system',
            'is_read' => false,
            'link' => null,
        ]);
    }
}
