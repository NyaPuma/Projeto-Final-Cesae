<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Database\Eloquent\Builder;

/**
 * Classe de exportação para ficheiro Excel utilizando o pacote Maatwebsite/Excel.
 * Implementa FromQuery para processar os dados em modo streaming,
 * evitando problemas de memória com grandes volumes de registos.
 */
class TicketsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithStyles
{
    /**
     * Query base para a exportação. Utiliza cursor-friendly eager loading mínimo.
     */
    public function query(): Builder
    {
        return Ticket::query()
            ->select([
                'id', 'title', 'status_id', 'priority',
                'opened_at', 'in_progress_at', 'closed_at',
                'minutes_spent', 'cost', 'budget_status', 'budget_amount'
            ])
            ->with(['status:id,name'])
            ->orderBy('created_at', 'desc');
    }

    /**
     * Define o cabeçalho da folha de cálculo.
     */
    public function headings(): array
    {
        return [
            'ID',
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
     * Mapeia cada registo Eloquent para uma linha da folha de cálculo.
     */
    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->title,
            $ticket->status->name ?? 'N/A',
            $ticket->priority,
            optional($ticket->opened_at)->format('d/m/Y H:i'),
            optional($ticket->in_progress_at)->format('d/m/Y H:i'),
            optional($ticket->closed_at)->format('d/m/Y H:i'),
            $ticket->minutes_spent,
            number_format((float)($ticket->cost ?? 0), 2, ',', '.'),
            $ticket->budget_status ?? 'N/A',
            number_format((float)($ticket->budget_amount ?? 0), 2, ',', '.'),
        ];
    }

    /**
     * Título da folha no ficheiro Excel.
     */
    public function title(): string
    {
        return 'Relatório de Tickets';
    }

    /**
     * Aplica estilos à folha – cabeçalho em negrito com fundo azul escuro.
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF1E3A5F']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
