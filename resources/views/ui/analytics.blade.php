@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@component('ui.partials.page-card', [
    'title' => __('Centro Analítico'),
    'subtitle' => __('Monitorização operacional da plataforma de gestão de avarias.'),
    'actions' => '<div class="flex flex-wrap gap-2">
        <a href="/analytics/export/csv" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all" id="btnExportCsv">
            <svg class="h-3.5 w-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            ' . __('Exportar CSV') . '
        </a>
        <a href="/analytics/export/pdf" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all" id="btnExportPdf">
            <svg class="h-3.5 w-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            ' . __('Exportar PDF') . '
        </a>
        <a href="/analytics/export/excel" class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all hover:opacity-90" id="btnExportExcel">
            <svg class="h-3.5 w-3.5 mr-1.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            ' . __('Exportar Excel') . '
        </a>
    </div>',
])

<div class="space-y-8">
    {{-- Banner de Monitorização --}}
    <section class="relative overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
        <div class="relative p-8 lg:p-10">
            <div class="grid gap-10 xl:grid-cols-[1.5fr_0.5fr]">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-primary">
                        <span class="h-2.5 w-2.5 rounded-full bg-primary animate-pulse"></span>
                        {{ __('Dashboard Analítico') }}
                    </span>
                    <h1 class="mt-6 text-4xl font-black tracking-tight">{{ __('Centro de Monitorização da Plataforma') }}</h1>
                    <p class="mt-5 max-w-3xl text-[15px] leading-8 text-[var(--text-soft)]">
                        {{ __('Visualize em tempo real o desempenho operacional, acompanhe indicadores de manutenção, distribuição dos equipamentos, produtividade da equipa técnica e evolução das ocorrências registadas.') }}
                    </p>
                </div>
                <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface-2)] p-6">
                    <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Estado') }}</span>
                    <div class="mt-4 flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-emerald-500 animate-ping"></span>
                        <span class="text-xl font-bold">{{ __('Operacional') }}</span>
                    </div>
                    <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Todos os serviços encontram-se disponíveis.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- KPIs Resumo --}}
    <section>
        <div class="mb-8 flex items-end justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Indicadores Operacionais') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Resumo da Plataforma') }}</h2>
                <p class="mt-2 max-w-2xl text-sm text-[var(--text-soft)]">{{ __('Indicadores principais da atividade do sistema.') }}</p>
            </div>
            <div class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3 lg:flex lg:flex-col">
                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-[var(--text-soft)]">{{ __('Atualização') }}</span>
                <span class="mt-1 text-lg font-bold">{{ __('Tempo Real') }}</span>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tempo Médio de Resolução') }}</p>
                <div class="mt-3 flex items-baseline justify-between">
                    <h3 id="kpiMttr" class="text-3xl font-black text-[var(--text)]">--</h3>
                    <span class="text-xl">🛠️</span>
                </div>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('MTTR') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tempo Médio de Espera') }}</p>
                <div class="mt-3 flex items-baseline justify-between">
                    <h3 id="kpiWaiting" class="text-3xl font-black text-[var(--text)]">--</h3>
                    <span class="text-xl">⏱️</span>
                </div>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Tempo até atribuição') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tickets Abertos') }}</p>
                <div class="mt-3 flex items-baseline justify-between">
                    <h3 id="kpiOpen" class="text-3xl font-black text-amber-500">--</h3>
                    <span class="text-xl">📂</span>
                </div>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Ocorrências ativas') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tickets Resolvidos') }}</p>
                <div class="mt-3 flex items-baseline justify-between">
                    <h3 id="kpiClosed" class="text-3xl font-black text-emerald-500">--</h3>
                    <span class="text-xl">✅</span>
                </div>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Intervenções concluídas') }}</p>
            </article>
        </div>
    </section>

    {{-- Gráficos --}}
    <section class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Desempenho') }}</span>
            <h3 class="mt-1 text-lg font-bold">{{ __('Tickets por Estado') }}</h3>
            <p class="text-xs text-[var(--text-soft)] mt-1 mb-4">{{ __('Distribuição atual das ocorrências de manutenção registadas na plataforma.') }}</p>
            <div class="h-64 flex items-center justify-center">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>

        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Inventário') }}</span>
            <h3 class="mt-1 text-lg font-bold">{{ __('Distribuição por Prioridade') }}</h3>
            <p class="text-xs text-[var(--text-soft)] mt-1 mb-4">{{ __('Divisão de volumetria por gravidade do ticket.') }}</p>
            <div class="h-64 flex items-center justify-center">
                <canvas id="chartPriority"></canvas>
            </div>
        </div>

        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Evolução') }}</span>
            <h3 class="mt-1 text-lg font-bold">{{ __('Tickets nos Últimos Meses') }}</h3>
            <p class="text-xs text-[var(--text-soft)] mt-1 mb-4">{{ __('Comparação entre tickets abertos, em curso e fechados.') }}</p>
            <div class="h-64 flex items-center justify-center">
                <canvas id="chartEvolution"></canvas>
            </div>
        </div>

        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Custos') }}</span>
            <h3 class="mt-1 text-lg font-bold">{{ __('Custo Mensal (€)') }}</h3>
            <p class="text-xs text-[var(--text-soft)] mt-1 mb-4">{{ __('Despesas acumuladas por intervenção concluída.') }}</p>
            <div class="h-64 flex items-center justify-center">
                <canvas id="chartCosts"></canvas>
            </div>
        </div>
    </section>

    {{-- Indicadores de SLA e Disponibilidade --}}
    <section>
        <div class="mb-6">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Estado do Sistema') }}</span>
            <h2 class="mt-1 text-2xl font-bold tracking-tight">{{ __('Indicadores Operacionais') }}</h2>
            <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('Tempo médio de resolução, SLA, disponibilidade e tempo de espera.') }}</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('MTTR') }}</p>
                <h3 id="statMttr" class="mt-2 text-2xl font-black text-[var(--text)]">--</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Tempo médio para resolver uma ocorrência.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Espera') }}</p>
                <h3 id="statWaiting" class="mt-2 text-2xl font-black text-[var(--text)]">--</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Tempo médio em fila de espera.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Disponibilidade') }}</p>
                <h3 id="statAvailability" class="mt-2 text-2xl font-black text-emerald-500">99.9%</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Disponibilidade da plataforma.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('SLA') }}</p>
                <h3 id="statSla" class="mt-2 text-2xl font-black text-blue-500">--</h3>
                <p class="mt-2 text-xs text-[var(--text-soft)]">{{ __('Sucesso no cumprimento dos prazos.') }}</p>
            </article>
        </div>
    </section>

    {{-- Rankings Operacionais --}}
    <section>
        <div class="mb-6">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">{{ __('Estatísticas') }}</span>
            <h2 class="mt-1 text-2xl font-bold tracking-tight">{{ __('Resumo Operacional') }}</h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <header class="border-b border-[var(--border)] p-5">
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Equipamentos com Mais Avarias') }}</h3>
                </header>
                <div id="topEquipments" class="divide-y divide-[var(--border)] p-2"></div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <header class="border-b border-[var(--border)] p-5">
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Salas Mais Afetadas') }}</h3>
                </header>
                <div id="topRooms" class="divide-y divide-[var(--border)] p-2"></div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <header class="border-b border-[var(--border)] p-5">
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Técnicos Mais Ativos') }}</h3>
                </header>
                <div id="topTechnicians" class="divide-y divide-[var(--border)] p-2"></div>
            </article>
        </div>
    </section>
</div>
@endcomponent
@endsection

@push('scripts')
<script>
function formatDynamicText(text) {
    if (!text) return '—';
    const locale = window.currentLocale || 'pt';
    if (locale !== 'en') return text;

    return String(text)
        .replace(/Ocorrência sintética/gi, 'Synthetic Incident')
        .replace(/Sala Operacional/gi, 'Operational Room')
        .replace(/Utilizador Sintético/gi, 'Synthetic User')
        .replace(/Equipamento Operacional/gi, 'Operational Equipment')
        .replace(/Linha de Montagem/gi, 'Assembly Line')
        .replace(/Servidor Central/gi, 'Central Server')
        .replace(/Laboratório de I&D/gi, 'R&D Laboratory')
        .replace(/Técnico/gi, 'Technician')
        .replace(/Administrador/gi, 'Administrator');
}

function renderRankingList(containerId, items, unit) {
    const el = document.getElementById(containerId);
    if (!el) return;

    if (!items || !items.length) {
        el.innerHTML = `<p class="text-xs text-[var(--text-soft)] italic text-center py-6">${__('Sem dados disponíveis.')}</p>`;
        return;
    }

    const translatedUnit = __(unit);

    el.innerHTML = items.slice(0, 5).map((item, idx) => `
        <div class="flex items-center justify-between px-3 py-3 hover:bg-[var(--surface-2)]/50 rounded-xl transition-colors">
            <div class="flex items-center gap-3 min-w-0">
                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-[var(--surface-2)] text-[11px] font-black text-[var(--text-soft)]">
                    ${idx + 1}
                </span>
                <span class="text-xs font-semibold text-[var(--text)] truncate">
                    ${formatDynamicText(item.name || item.title || item.label || '—')}
                </span>
            </div>
            <span class="text-xs font-bold text-primary shrink-0 ml-2">
                ${item.count || item.total || item.tickets_count || 0} ${translatedUnit}
            </span>
        </div>
    `).join('');
}

async function loadAnalytics() {
    const headers = typeof authHeader === 'function' ? authHeader() : { 'Accept': 'application/json' };

    try {
        const response = await fetch('/analytics', { headers });
        if (!response.ok) throw new Error('Falha ao obter dados analíticos');
        const data = await response.json();

        // 1. Preencher KPIs Principais
        document.getElementById('kpiMttr').innerText = data.average_resolution_human || `${data.average_resolution_minutes || 0} min`;
        document.getElementById('kpiWaiting').innerText = data.average_waiting_human || `${data.average_waiting_minutes || 0} min`;
        document.getElementById('kpiOpen').innerText = data.open_tickets ?? (data.status_counts?.open || 0);
        document.getElementById('kpiClosed').innerText = data.closed_tickets ?? (data.status_counts?.closed || 0);

        // 2. Preencher Indicadores de Estado
        document.getElementById('statMttr').innerText = `${data.average_resolution_minutes || 0} min`;
        document.getElementById('statWaiting').innerText = `${data.average_waiting_minutes || 0} min`;
        document.getElementById('statSla').innerText = `${data.sla_success ?? 100}%`;
        if (data.system_availability) {
            document.getElementById('statAvailability').innerText = `${data.system_availability}%`;
        }

        // 3. Renderizar Rankings
        renderRankingList('topEquipments', data.top_equipments || [], 'intervenções');
        renderRankingList('topRooms', data.top_rooms || [], 'tickets');
        renderRankingList('topTechnicians', data.top_technicians || [], 'ações');

        // 4. Inicializar Gráficos (Chart.js)
        renderCharts(data);

    } catch (e) {
        console.error('Erro no Analytics:', e);
    }
}

function renderCharts(data) {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#94a3b8' : '#64748b';

    // Gráfico 1: Tickets por Estado
    const ctxStatus = document.getElementById('chartStatus');
    if (ctxStatus) {
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: [__('Aberto'), __('Em Curso'), __('Fechado')],
                datasets: [{
                    data: [
                        data.status_counts?.open || data.open_tickets || 0,
                        data.status_counts?.in_progress || 0,
                        data.status_counts?.closed || data.closed_tickets || 0
                    ],
                    backgroundColor: ['#3b82f6', '#f59e0b', '#10b981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { labels: { color: textColor, font: { size: 11 } } } }
            }
        });
    }

    // Gráfico 2: Prioridade
    const ctxPriority = document.getElementById('chartPriority');
    if (ctxPriority) {
        new Chart(ctxPriority, {
            type: 'pie',
            data: {
                labels: [__('Baixa'), __('Média'), __('Alta'), __('Crítica')],
                datasets: [{
                    data: [
                        data.priority_counts?.low || data.priority_counts?.baixa || 0,
                        data.priority_counts?.medium || data.priority_counts?.média || 0,
                        data.priority_counts?.high || data.priority_counts?.alta || 0,
                        data.priority_counts?.critical || data.priority_counts?.crítica || 0
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#f97316', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { labels: { color: textColor, font: { size: 11 } } } }
            }
        });
    }
}

window.addEventListener('load', loadAnalytics);
</script>
@endpush