@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

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
    <section class="relative overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-primary/10 blur-[120px]"></div>
            <div class="absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-blue-500/5 blur-[90px]"></div>
        </div>

        <div class="relative p-8 lg:p-10">
            <div class="grid gap-10 xl:grid-cols-[1.5fr_0.5fr]">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-primary">
                        <span class="h-2.5 w-2.5 rounded-full bg-primary animate-pulse"></span>
                        {{ __('Dashboard Analítico') }}
                    </span>
                    <h1 class="mt-6 text-4xl font-black tracking-tight">{{ __('Centro de Monitorização da Plataforma') }}</h1>
                    <p class="mt-5 max-w-3xl text-[15px] leading-8 text-soft">
                        {{ __('Visualize em tempo real o desempenho operacional, acompanhe indicadores de manutenção, distribuição dos equipamentos, produtividade da equipa técnica e evolução das ocorrências registadas.') }}
                    </p>
                </div>

                <div class="flex flex-col justify-between rounded-3xl border border-[var(--border)] bg-[var(--surface-2)] p-7">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Estado') }}</p>
                        <h2 class="mt-4 text-3xl font-black">{{ __('Operacional') }}</h2>
                        <p class="mt-2 text-sm text-soft">{{ __('Todos os serviços encontram-se disponíveis.') }}</p>
                    </div>
                    <div class="mt-10 inline-flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-semibold text-emerald-500">{{ __('Online') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-8 flex items-end justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Indicadores Operacionais') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Resumo da Plataforma') }}</h2>
                <p class="mt-2 max-w-2xl text-sm text-soft">{{ __('Indicadores principais da atividade do sistema. Os valores são atualizados automaticamente a partir da base de dados.') }}</p>
            </div>
            <div class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3 lg:flex lg:flex-col">
                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">{{ __('Atualização') }}</span>
                <span class="mt-1 text-lg font-bold">{{ __('Tempo Real') }}</span>
            </div>
        </div>

        <div id="kpiPanel" class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @for ($i = 0; $i < 4; $i++)
                <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <div class="p-6">
                        <div class="h-4 w-28 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                        <div class="mt-6 h-10 w-24 animate-pulse rounded-xl bg-[var(--surface-2)]"></div>
                        <div class="mt-6 h-3 w-40 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                        <div class="mt-8 flex items-center justify-between">
                            <div class="h-8 w-20 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                            <div class="h-8 w-8 animate-pulse rounded-2xl bg-[var(--surface-2)]"></div>
                        </div>
                    </div>
                </article>
            @endfor
        </div>
    </section>

    <section class="grid gap-8 2xl:grid-cols-[1.2fr_0.8fr]">
        <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
            <header class="flex flex-col gap-6 border-b border-[var(--border)] p-8 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Desempenho') }}</span>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Tickets por Estado') }}</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-soft">{{ __('Distribuição atual das ocorrências de manutenção registadas na plataforma.') }}</p>
                </div>
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">{{ __('Atualização') }}</p>
                    <p class="mt-2 text-lg font-bold">{{ __('Em tempo real') }}</p>
                </div>
            </header>
            <div class="p-8">
                <div class="h-[420px]"><canvas id="statusChart"></canvas></div>
            </div>
        </article>

        <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
            <header class="border-b border-[var(--border)] p-8">
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Inventário') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Equipamentos') }}</h2>
                <p class="mt-3 text-sm leading-7 text-soft">{{ __('Distribuição do parque tecnológico por categoria.') }}</p>
            </header>
            <div class="p-8">
                <div class="relative mx-auto flex h-[300px] w-[300px] items-center justify-center">
                    <canvas id="equipmentChart"></canvas>
                    <div id="equipmentTotal" class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-5xl font-black">--</span>
                        <span class="mt-2 text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Equipamentos') }}</span>
                    </div>
                </div>
                <div id="equipmentLegend" class="mt-10 space-y-3"></div>
            </div>
        </article>
    </section>

    <section class="grid gap-8 xl:grid-cols-2">
        <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
            <header class="border-b border-[var(--border)] p-8">
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Evolução') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Tickets nos Últimos Meses') }}</h2>
                <p class="mt-3 text-sm leading-7 text-soft">{{ __('Comparação entre tickets abertos, em curso e fechados.') }}</p>
            </header>
            <div class="p-8"><div class="h-[320px]"><canvas id="trendChart"></canvas></div></div>
        </article>

        <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
            <header class="border-b border-[var(--border)] p-8">
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Custos') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Custo Mensal') }}</h2>
                <p class="mt-3 text-sm leading-7 text-soft">{{ __('Despesas acumuladas por intervenção concluída.') }}</p>
            </header>
            <div class="p-8"><div class="h-[320px]"><canvas id="costChart"></canvas></div></div>
        </article>
    </section>

    <section>
        <div class="mb-8">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Estado do Sistema') }}</span>
            <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Indicadores Operacionais') }}</h2>
            <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">{{ __('Tempo médio de resolução, SLA, disponibilidade e tempo de espera até a atribuição.') }}</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('MTTR') }}</p>
                        <h3 id="metricMttr" class="mt-4 text-4xl font-black">--</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500/10">
                        <svg class="h-7 w-7 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" /><circle cx="12" cy="12" r="9" /></svg>
                    </div>
                </div>
                <p class="mt-6 text-sm text-soft">{{ __('Tempo médio necessário para resolver uma ocorrência.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Espera') }}</p>
                        <h3 id="metricWaiting" class="mt-4 text-4xl font-black">--</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500/10">
                        <svg class="h-7 w-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" /></svg>
                    </div>
                </div>
                <p class="mt-6 text-sm text-soft">{{ __('Tempo médio até um técnico assumir a intervenção.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Disponibilidade') }}</p>
                        <h3 id="metricAvailability" class="mt-4 text-4xl font-black">99.9%</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/10">
                        <svg class="h-7 w-7 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </div>
                </div>
                <p class="mt-6 text-sm text-soft">{{ __('Disponibilidade estimada da plataforma.') }}</p>
            </article>

            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('SLA') }}</p>
                        <h3 id="metricSla" class="mt-4 text-4xl font-black">--</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-500/10">
                        <svg class="h-7 w-7 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" /></svg>
                    </div>
                </div>
                <p class="mt-6 text-sm text-soft">{{ __('Percentagem de intervenções dentro do tempo previsto.') }}</p>
            </article>
        </div>
    </section>

    <section>
        <div class="mb-8 flex items-end justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Histórico') }}</span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Atividade Recente') }}</h2>
                <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">{{ __('Últimas ações registadas na plataforma para acompanhar rapidamente a atividade operacional.') }}</p>
            </div>
            <span class="rounded-full border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2 text-xs font-semibold uppercase tracking-[0.16em]">{{ __('Últimas 24 horas') }}</span>
        </div>

        <div class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
            <div id="activityTimeline" class="divide-y divide-[var(--border)]">
                <div class="flex items-start gap-5 p-6">
                    <div class="mt-1 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10">
                        <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="font-semibold">{{ __('A carregar atividade...') }}</h3>
                            <span class="text-xs text-soft">--</span>
                        </div>
                        <p class="mt-2 text-sm text-soft">{{ __('A obter os eventos mais recentes da plataforma.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-8">
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Estatísticas') }}</span>
            <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Resumo Operacional') }}</h2>
            <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">{{ __('Consulte rapidamente os equipamentos mais afetados, as salas mais recorrentes e os técnicos mais ativos.') }}</p>
        </div>

        <div class="grid gap-8 xl:grid-cols-3">
            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                <header class="border-b border-[var(--border)] p-6">
                    <h3 class="text-lg font-bold">{{ __('Equipamentos com Mais Avarias') }}</h3>
                    <p class="mt-2 text-sm text-soft">{{ __('Ranking dos equipamentos mais intervencionados.') }}</p>
                </header>
                <div id="topEquipments" class="divide-y divide-[var(--border)]"></div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                <header class="border-b border-[var(--border)] p-6">
                    <h3 class="text-lg font-bold">{{ __('Salas Mais Afetadas') }}</h3>
                    <p class="mt-2 text-sm text-soft">{{ __('Locais com maior número de ocorrências.') }}</p>
                </header>
                <div id="topRooms" class="divide-y divide-[var(--border)]"></div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                <header class="border-b border-[var(--border)] p-6">
                    <h3 class="text-lg font-bold">{{ __('Técnicos Mais Ativos') }}</h3>
                    <p class="mt-2 text-sm text-soft">{{ __('Colaboradores com maior número de intervenções.') }}</p>
                </header>
                <div id="topTechnicians" class="divide-y divide-[var(--border)]"></div>
            </article>
        </div>
    </section>

    <div id="analyticsMessage" class="hidden rounded-2xl border px-5 py-4 text-sm font-medium"></div>
</div>
@endcomponent
@endsection
