<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use RuntimeException;

final class AnalyticsExportService
{
    public function __construct(
        private readonly ?LocalizationService $localization = null,
    ) {}

    private const CSV_DELIMITER = ';';

    /** @var list<string> */
    private const CSV_HEADERS = [
        'ID',
        'Código',
        'Título',
        'Estado',
        'Prioridade',
        'Urgente',
        'Abertura',
        'Em Curso',
        'Fecho',
        'Duração (min)',
        'Custo (€)',
        'Estado Orçamento',
        'Montante Orçamento (€)',
    ];

    /** @var list<string> */
    private const PDF_SELECT = [
        'id',
        'reference',
        'title',
        'priority',
        'urgent',
        'status_id',
        'opened_at',
        'in_progress_at',
        'closed_at',
        'minutes_spent',
        'actual_cost',
        'budget_status',
        'budget_amount',
    ];

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

        $tickets = Ticket::select(self::PDF_SELECT)
            ->with('status')
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
        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, self::CSV_HEADERS, self::CSV_DELIMITER);

        Ticket::select(self::PDF_SELECT)
            ->with('status')
            ->whereNull('tickets.deleted_at')
            ->chunk(500, function ($tickets) use ($handle): void {
                foreach ($tickets as $ticket) {
                    fputcsv($handle, $this->csvRow($ticket), self::CSV_DELIMITER);
                }
            });
    }

    /**
     * Converte um ticket numa linha CSV legível.
     *
     * @return list<string>
     */
    private function csvRow(Ticket $ticket): array
    {
        return [
            (string) $ticket->id,
            $ticket->reference ?? '#'.$ticket->id,
            $ticket->title,
            $this->statusLabel($ticket),
            $this->priorityLabel($ticket->priority),
            $ticket->urgent ? 'Sim' : 'Não',
            $this->localization()->formatDateTime($ticket->opened_at),
            $this->localization()->formatDateTime($ticket->in_progress_at),
            $this->localization()->formatDateTime($ticket->closed_at),
            (string) ($ticket->minutes_spent ?? ''),
            $this->localization()->formatDecimal((float) $ticket->actual_cost),
            $this->budgetLabel($ticket->budget_status),
            $ticket->budget_amount !== null ? $this->localization()->formatDecimal((float) $ticket->budget_amount) : '',
        ];
    }

    private function statusLabel(Ticket $ticket): string
    {
        $name = $ticket->status?->name;

        return TicketStatusEnum::tryFrom((string) $name)?->label()
            ?? (ucfirst((string) $name) ?: '—');
    }

    private function priorityLabel(?string $priority): string
    {
        return TicketPriorityEnum::tryFrom((string) $priority)?->label()
            ?? ucfirst((string) $priority);
    }

    private function budgetLabel(?string $status): string
    {
        return BudgetStatusEnum::tryFrom((string) $status)?->label() ?? '';
    }

    private function localization(): LocalizationService
    {
        return $this->localization ?? app(LocalizationService::class);
    }

}
