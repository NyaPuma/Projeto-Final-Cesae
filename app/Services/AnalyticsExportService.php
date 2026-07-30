<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use RuntimeException;

final class AnalyticsExportService
{
    /**
     * Exporta os dados dos tickets diretamente para a saída padrão (CSV).
     *
     * @throws RuntimeException
     */
    public function exportCsv(): void
    {
        $handle = fopen('php://output', 'w');

        if ($handle === false) {
            throw new RuntimeException('Não foi possível abrir o fluxo de saída padrão.');
        }

        try {
            $this->writeCsvRows($handle);
        } finally {
            fclose($handle);
        }
    }

    /**
     * Exporta os dados dos tickets para um ficheiro CSV no caminho especificado.
     *
     * @param string $path
     * @throws RuntimeException
     */
    public function exportCsvToFile(string $path): void
    {
        $this->ensureDirectoryExists($path);

        $handle = fopen($path, 'w');

        if ($handle === false) {
            throw new RuntimeException("Não foi possível abrir o ficheiro para escrita: {$path}");
        }

        try {
            $this->writeCsvRows($handle);
        } finally {
            fclose($handle);
        }
    }

    /**
     * Exporta o relatório analítico em formato PDF para o caminho especificado.
     *
     * @param string $path
     */
    public function exportPdfToFile(string $path): void
    {
        $this->ensureDirectoryExists($path);

        $tickets = Ticket::select([
            'id',
            'title',
            'status_id',
            'opened_at',
            'in_progress_at',
            'closed_at',
            'minutes_spent',
            'cost',
            'budget_status',
            'budget_amount',
        ])
            ->whereNull('tickets.deleted_at')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('reports.tickets', ['tickets' => $tickets]);
        $pdf->save($path);
    }

    /**
     * Garante que o diretório pai do caminho do ficheiro existe.
     *
     * @param string $path
     * @throws RuntimeException
     */
    private function ensureDirectoryExists(string $path): void
    {
        $dir = dirname($path);

        if (! is_dir($dir) && ! mkdir($dir, 0755, true) && ! is_dir($dir)) {
            throw new RuntimeException("Não foi possível criar o diretório: {$dir}");
        }
    }

    /**
     * Escreve o cabeçalho e as linhas de dados em formato CSV no ponteiro fornecido.
     *
     * @param resource $handle
     */
    private function writeCsvRows($handle): void
    {
        fputcsv($handle, [
            'id',
            'title',
            'status_id',
            'opened_at',
            'in_progress_at',
            'closed_at',
            'minutes_spent',
            'cost',
            'budget_status',
            'budget_amount',
        ]);

        Ticket::select([
            'id',
            'title',
            'status_id',
            'opened_at',
            'in_progress_at',
            'closed_at',
            'minutes_spent',
            'cost',
            'budget_status',
            'budget_amount',
        ])
            ->whereNull('tickets.deleted_at')
            ->chunk(500, function ($tickets) use ($handle): void {
                foreach ($tickets as $ticket) {
                    fputcsv($handle, [
                        $ticket->id,
                        $ticket->title,
                        $ticket->status_id,
                        $ticket->opened_at?->toDateTimeString(),
                        $ticket->in_progress_at?->toDateTimeString(),
                        $ticket->closed_at?->toDateTimeString(),
                        $ticket->minutes_spent,
                        $ticket->cost,
                        $ticket->budget_status,
                        $ticket->budget_amount,
                    ]);
                }
            });
    }
}
