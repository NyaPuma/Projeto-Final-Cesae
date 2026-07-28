<?php

namespace App\Services;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

final class AnalyticsExportService
{
    public function exportCsv(): void
    {
        $handle = fopen('php://output', 'w');
        $this->writeCsvRows($handle);
        fclose($handle);
    }

    public function exportCsvToFile(string $path): void
    {
        $this->ensureDirectoryExists($path);
        $handle = fopen($path, 'w');
        $this->writeCsvRows($handle);
        fclose($handle);
    }

    public function exportPdfToFile(string $path): void
    {
        $this->ensureDirectoryExists($path);

        $tickets = Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])->get();

        $pdf = Pdf::loadView('reports.tickets', ['tickets' => $tickets]);
        $pdf->save($path);
    }

    private function ensureDirectoryExists(string $path): void
    {
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    private function writeCsvRows($handle): void
    {
        fputcsv($handle, ['id', 'title', 'status_id', 'opened_at', 'in_progress_at', 'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount']);

        Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])
            ->whereNull('tickets.deleted_at')
            ->chunk(500, function ($tickets) use ($handle) {
                foreach ($tickets as $ticket) {
                    fputcsv($handle, [
                        $ticket->id,
                        $ticket->title,
                        $ticket->status_id,
                        optional($ticket->opened_at)->toDateTimeString(),
                        optional($ticket->in_progress_at)->toDateTimeString(),
                        optional($ticket->closed_at)->toDateTimeString(),
                        $ticket->minutes_spent,
                        $ticket->cost,
                        $ticket->budget_status,
                        $ticket->budget_amount,
                    ]);
                }
            });
    }
}
