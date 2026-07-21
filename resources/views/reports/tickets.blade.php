<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Tickets Report</title>
    <style>
        /* Configuração de Página e Margens de Impressão */
        @page {
            margin: 40px 30px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, 'DejaVu Sans', Arial, sans-serif;
            color: #1b1b18;
            line-height: 1.4;
            font-size: 11px;
        }

        /* Estrutura de Cabeçalho Corporativo e Metadados */
        .report-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .report-header td {
            padding: 0;
            border: none;
        }
        .report-title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #1b1b18;
            margin: 0;
        }
        .report-meta {
            text-align: right;
            font-size: 9px;
            font-family: 'DejaVu Sans Mono', monospace;
            color: #706f6c;
        }

        /* Matriz de Dados Analíticos */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th {
            padding: 8px 5px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #706f6c;
            border-bottom: 1px solid #1b1b18;
            text-align: left;
        }
        table.data-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #e3e3e0;
            vertical-align: top;
            font-size: 10px;
        }

        /* Otimização para PDF: impede quebras de linha a meio de um registo */
        table.data-table tbody tr {
            page-break-inside: avoid;
        }

        /* Linhas Alternadas Suaves para Leitura em Massa */
        table.data-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Utilitários de Alinhamento de Alta Precisão */
        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }

        /* Tipografia de Dados Estruturados */
        .font-mono {
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 9px;
            color: #555450;
        }
        .font-bold {
            font-weight: 600;
        }
        .text-muted {
            color: #a1a09a;
        }

        /* Classes Extraídas para Limpeza do Loop */
        .status-text {
            text-transform: uppercase;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
        .budget-status-text {
            font-size: 9px;
            text-transform: uppercase;
            color: #555450;
        }
        .table-total-row {
            border-top: 2px solid #1b1b18;
            font-weight: 700;
            background-color: #f5f5f3 !important;
        }
    </style>
</head>
<body>

    {{-- Layout de Cabeçalho via Tabela Clássica para Compatibilidade Estrita com PDF --}}
    <table class="report-header">
        <tr>
            <td>
                <h1 class="report-title">Relatório Consolidado de Tickets</h1>
                <div style="font-size: 10px; color: #706f6c; margin-top: 3px;">
                    Análise analítica de estados operacionais, tempos de resolução e custos.
                </div>
            </td>
            <td class="report-meta">
                <div>DOCUMENTO AUTOMÁTICO</div>
                <div style="margin-top: 2px;">EMISSÃO: {{ now()->format('Y-m-d H:i') }}</div>
                <div>REGISTOS: {{ $tickets->count() }}</div>
            </td>
        </tr>
    </table>

    {{-- Tabela Principal de Auditoria Qualitativa e Financeira --}}
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 45px;">ID</th>
                <th>Título do Incidente</th>
                <th style="width: 70px;">Estado</th>
                <th style="width: 95px;">Abertura</th>
                <th style="width: 95px;">Em Curso</th>
                <th style="width: 95px;">Fecho</th>
                <th class="text-right" style="width: 55px;">Duração</th>
                <th class="text-right" style="width: 65px;">Custo</th>
                <th style="width: 75px;">Orçam. Est.</th>
                <th class="text-right" style="width: 75px;">Orçam. Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $t)
                <tr>
                    <td class="font-mono">#{{ $t->id }}</td>
                    <td class="font-bold" style="color: #1b1b18;">{{ $t->title }}</td>
                    <td>
                        <span class="status-text">
                            {{ $t->status->name ?? $t->status ?? '—' }}
                        </span>
                    </td>
                    <td class="font-mono">{{ $t->opened_at?->toDateTimeString() ?? '—' }}</td>
                    <td class="font-mono">{{ $t->in_progress_at?->toDateTimeString() ?? '—' }}</td>
                    <td class="font-mono">{{ $t->closed_at?->toDateTimeString() ?? '—' }}</td>

                    {{-- Alinhamento Numérico / Temporal --}}
                    <td class="text-right font-mono">
                        @if($t->minutes_spent)
                            {{ number_format($t->minutes_spent) }} <span class="text-muted">m</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>

                    {{-- Alinhamento Monetário --}}
                    <td class="text-right font-mono font-bold">
                        @if($t->cost)
                            {{ number_format($t->cost, 2, ',', '.') }} €
                        @else
                            <span class="text-muted">0,00 €</span>
                        @endif
                    </td>

                    <td class="budget-status-text">
                        {{ $t->budget_status ?? '—' }}
                    </td>

                    <td class="text-right font-mono">
                        @if($t->budget_amount)
                            {{ number_format($t->budget_amount, 2, ',', '.') }} €
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted" style="padding: 24px;">
                        Nenhum registo de ticket encontrado para os parâmetros selecionados.
                    </td>
                </tr>
            @endforelse
        </tbody>

        {{-- Linha de Totais Acumulados para Fecho Contabilístico --}}
        @if($tickets->isNotEmpty())
            <tfoot>
                <tr class="table-total-row">
                    <td colspan="6" class="font-bold" style="text-transform: uppercase; letter-spacing: 0.05em;">
                        Total Consolidado
                    </td>
                    <td class="text-right font-mono">
                        {{ number_format($tickets->sum('minutes_spent')) }} <span class="text-muted">m</span>
                    </td>
                    <td class="text-right font-mono">
                        {{ number_format($tickets->sum('cost'), 2, ',', '.') }} €
                    </td>
                    <td></td>
                    <td class="text-right font-mono">
                        {{ number_format($tickets->sum('budget_amount'), 2, ',', '.') }} €
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>

</body>
</html>
