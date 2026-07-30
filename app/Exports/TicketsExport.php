<?php

namespace App\Exports;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Classe de exportação de Tickets para Excel.
 * Suporta filtragem dinâmica, formatação nativa de moedas/datas e leitura em blocos.
 */
final class TicketsExport implements
    FromQuery,
    ShouldAutoSize,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    WithColumnFormatting,
    WithChunkReading
{
    /**
     * Permite injetar uma query personalizada/filtrada a partir do Controller.
     */
    public function __construct(
        private readonly ?Builder $customQuery = null
    ) {}

    /**
     * Query base para a exportação.
     */
    public function query(): Builder
    {
        return ($this->customQuery ?? Ticket::query())
            ->select([
                'id',
                'reference',
                'title',
                'status_id',
                'priority',
                'opened_at',
                'in_progress_at',
                'closed_at',
                'minutes_spent',
                'actual_cost',
                'budget_status',
                'budget_amount',
                'created_at',
            ])
            ->orderBy('created_at', 'desc');
    }

    /**
     * Tamanho dos blocos de leitura na base de dados para otimização de memória.
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * Cabeçalho da folha de cálculo.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Título',
            'Estado',
            'Prioridade',
            'Aberto em',
            'Em Progresso em',
            'Fechado em',
            'Minutos Gastos',
            'Custo (€)',
            'Estado Orçamento',
            'Montante Orçamento (€)',
        ];
    }

    /**
     * Mapeia cada registo Eloquent para uma linha do Excel.
     *
     * @param Ticket $ticket
     */
    public function map(mixed $ticket): array
    {
        /** @var Ticket $ticket */
        $statusLabel = $ticket->status instanceof TicketStatusEnum
            ? $ticket->status->label()
            : ($ticket->status->name ?? (string) ($ticket->status ?? 'N/A'));

        $priorityLabel = $ticket->priority instanceof TicketPriorityEnum
            ? $ticket->priority->label()
            : (string) ($ticket->priority ?? 'N/A');

        return [
            $ticket->id,
            $ticket->reference ?? "#{$ticket->id}",
            $ticket->title,
            $statusLabel,
            $priorityLabel,
            $ticket->opened_at?->format('d/m/Y H:i') ?? '-',
            $ticket->in_progress_at?->format('d/m/Y H:i') ?? '-',
            $ticket->closed_at?->format('d/m/Y H:i') ?? '-',
            $ticket->minutes_spent ?? 0,
            (float) ($ticket->actual_cost ?? 0),
            $ticket->budget_status ?? 'N/A',
            (float) ($ticket->budget_amount ?? 0),
        ];
    }

    /**
     * Formatação nativa das colunas no Excel (Permite cálculos e somas nas células).
     */
    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => '#,##0.00 "€"',
            'L' => '#,##0.00 "€"',
        ];
    }

    /**
     * Título do separador no Excel.
     */
    public function title(): string
    {
        return 'Relatório de Tickets';
    }

    /**
     * Estilização visual da folha (Cabeçalho).
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF1E3A5F']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
