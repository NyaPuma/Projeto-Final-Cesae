@extends('ui.layout')

@section('content')
    <script>
        // Marcar que esta página requer autenticação
        window.requireAuthOnLoad = true;
    </script>

    {{-- Carregamento da Biblioteca Chart.js para os gráficos --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @component('ui.partials.page-card', [
        'title' => __('Centro Analítico'),
        'subtitle' => __('Monitorização operacional da plataforma de gestão de avarias.'),
        'actions' =>
            '<div class="flex flex-wrap gap-2">
                                        <a href="/analytics/export/csv" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all" id="btnExportCsv">
                                            <svg class="h-3.5 w-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            ' .
            __('Exportar CSV') .
            '
                                        </a>
                                        <a href="/analytics/export/pdf" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all" id="btnExportPdf">
                                            <svg class="h-3.5 w-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            ' .
            __('Exportar PDF') .
            '
                                        </a>
                                        <a href="/analytics/export/excel" class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all hover:opacity-90" id="btnExportExcel">
                                            <svg class="h-3.5 w-3.5 mr-1.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            ' .
            __('Exportar Excel') .
            '
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
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-primary">
                                <span class="h-2.5 w-2.5 rounded-full bg-primary animate-pulse"></span>
                                {{ __('Dashboard Analítico') }}
                            </span>
                            <h1 class="mt-6 text-4xl font-black tracking-tight">{{ __('Centro de Monitorização da Plataforma') }}
                            </h1>
                            <p class="mt-5 max-w-3xl text-[15px] leading-8 text-soft">
                                {{ __('Visualize em tempo real o desempenho operacional, acompanhe indicadores de manutenção, distribuição dos equipamentos, produtividade da equipa técnica e evolução das ocorrências registadas.') }}
                            </p>
                        </div>

                        <div
                            class="flex flex-col justify-between rounded-3xl border border-[var(--border)] bg-[var(--surface-2)] p-7">
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

            {{-- KPIs Resumo --}}
            <section>
                <div class="mb-8 flex items-end justify-between">
                    <div>
                        <span
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Indicadores Operacionais') }}</span>
                        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Resumo da Plataforma') }}</h2>
                        <p class="mt-2 max-w-2xl text-sm text-soft">{{ __('Indicadores principais da atividade do sistema.') }}
                        </p>
                    </div>
                    <div
                        class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3 lg:flex lg:flex-col">
                        <span
                            class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">{{ __('Atualização') }}</span>
                        <span class="mt-1 text-lg font-bold">{{ __('Tempo Real') }}</span>
                    </div>
                </div>

                <div id="kpiPanel" class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    {{-- Injetado Dinamicamente pelo JS --}}
                </div>
            </section>

            {{-- Gráficos Estado & Equipamentos --}}
            <section class="grid gap-8 2xl:grid-cols-[1.2fr_0.8fr]">
                <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <header
                        class="flex flex-col gap-6 border-b border-[var(--border)] p-8 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <span
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Desempenho') }}</span>
                            <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Tickets por Estado') }}</h2>
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-soft">
                                {{ __('Distribuição atual das ocorrências de manutenção registadas na plataforma.') }}</p>
                        </div>
                    </header>
                    <div class="p-8">
                        <div class="h-[380px]"><canvas id="statusChart"></canvas></div>
                    </div>
                </article>

                <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <header class="border-b border-[var(--border)] p-8">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Inventário') }}</span>
                        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Distribuição por Prioridade') }}</h2>
                        <p class="mt-3 text-sm leading-7 text-soft">{{ __('Divisão de volumetria por gravidade do ticket.') }}
                        </p>
                    </header>
                    <div class="p-8">
                        <div class="relative mx-auto flex h-[280px] w-[280px] items-center justify-center">
                            <canvas id="equipmentChart"></canvas>
                        </div>
                    </div>
                </article>
            </section>

            {{-- Gráficos Evolução e Custos --}}
            <section class="grid gap-8 xl:grid-cols-2">
                <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <header class="border-b border-[var(--border)] p-8">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Evolução') }}</span>
                        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Tickets nos Últimos Meses') }}</h2>
                        <p class="mt-3 text-sm leading-7 text-soft">
                            {{ __('Comparação entre tickets abertos, em curso e fechados.') }}</p>
                    </header>
                    <div class="p-8">
                        <div class="h-[320px]"><canvas id="trendChart"></canvas></div>
                    </div>
                </article>

                <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <header class="border-b border-[var(--border)] p-8">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Custos') }}</span>
                        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Custo Mensal (€)') }}</h2>
                        <p class="mt-3 text-sm leading-7 text-soft">{{ __('Despesas acumuladas por intervenção concluída.') }}
                        </p>
                    </header>
                    <div class="p-8">
                        <div class="h-[320px]"><canvas id="costChart"></canvas></div>
                    </div>
                </article>
            </section>

            {{-- Métricas de Estado --}}
            <section>
                <div class="mb-8">
                    <span
                        class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Estado do Sistema') }}</span>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Indicadores Operacionais') }}</h2>
                    <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">
                        {{ __('Tempo médio de resolução, SLA, disponibilidade e tempo de espera.') }}</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('MTTR') }}</p>
                                <h3 id="metricMttr" class="mt-4 text-lg font-black truncate">--</h3>
                            </div>
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-500 font-bold">
                                ⏱️</div>
                        </div>
                        <p class="mt-4 text-xs text-soft">{{ __('Tempo médio para resolver uma ocorrência.') }}</p>
                    </article>

                    <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Espera') }}</p>
                                <h3 id="metricWaiting" class="mt-4 text-lg font-black truncate">--</h3>
                            </div>
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-500/10 text-blue-500 font-bold">
                                ⏳</div>
                        </div>
                        <p class="mt-4 text-xs text-soft">{{ __('Tempo médio em fila de espera.') }}</p>
                    </article>

                    <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">
                                    {{ __('Disponibilidade') }}</p>
                                <h3 id="metricAvailability" class="mt-4 text-3xl font-black">99.9%</h3>
                            </div>
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-500/10 text-purple-500 font-bold">
                                ⚡</div>
                        </div>
                        <p class="mt-4 text-xs text-soft">{{ __('Disponibilidade da plataforma.') }}</p>
                    </article>

                    <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('SLA') }}</p>
                                <h3 id="metricSla" class="mt-4 text-3xl font-black">--</h3>
                            </div>
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500 font-bold">
                                🎯</div>
                        </div>
                        <p class="mt-4 text-xs text-soft">{{ __('Sucesso no cumprimento dos prazos.') }}</p>
                    </article>
                </div>
            </section>

            {{-- Atividade Recente --}}
            <section>
                <div class="mb-8 flex items-end justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Histórico') }}</span>
                        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Atividade Recente') }}</h2>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                    <div id="activityTimeline" class="divide-y divide-[var(--border)]">
                        <p class="p-6 text-xs text-soft italic">{{ __('A carregar auditoria...') }}</p>
                    </div>
                </div>
            </section>

            {{-- Rankings Operacionais --}}
            <section>
                <div class="mb-8">
                    <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ __('Estatísticas') }}</span>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Resumo Operacional') }}</h2>
                </div>

                <div class="grid gap-8 xl:grid-cols-3">
                    <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                        <header class="border-b border-[var(--border)] p-6">
                            <h3 class="text-lg font-bold">{{ __('Equipamentos com Mais Avarias') }}</h3>
                        </header>
                        <div id="topEquipments" class="divide-y divide-[var(--border)]"></div>
                    </article>

                    <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                        <header class="border-b border-[var(--border)] p-6">
                            <h3 class="text-lg font-bold">{{ __('Salas Mais Afetadas') }}</h3>
                        </header>
                        <div id="topRooms" class="divide-y divide-[var(--border)]"></div>
                    </article>

                    <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                        <header class="border-b border-[var(--border)] p-6">
                            <h3 class="text-lg font-bold">{{ __('Técnicos Mais Ativos') }}</h3>
                        </header>
                        <div id="topTechnicians" class="divide-y divide-[var(--border)]"></div>
                    </article>
                </div>
            </section>

            <div id="analyticsMessage" class="hidden rounded-2xl border px-5 py-4 text-sm font-medium"></div>
        </div>
    @endcomponent

    {{-- Motor JavaScript de Leitura e Renderização --}}
    @push('scripts')
        <script>
            let charts = {};

            async function loadAnalytics() {
                try {
                    const response = await fetch('/analytics', {
                        headers: authHeader()
                    });

                    if (!response.ok) throw new Error('Falha ao comunicar com o servidor');

                    const data = await response.json();

                    // 1. Renderizar KPIs Resumo com strings traduzíveis via função __(...)
                    document.getElementById('kpiPanel').innerHTML = `
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-soft">${__( 'Abertos' )}</p>
                <h3 class="mt-3 text-3xl font-black text-amber-500">${data.open_tickets || 0}</h3>
                <p class="mt-2 text-xs text-soft">${__( 'Ocorrências pendentes' )}</p>
            </article>
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-soft">${__( 'Em Curso' )}</p>
                <h3 class="mt-3 text-3xl font-black text-blue-500">${data.in_progress_tickets || 0}</h3>
                <p class="mt-2 text-xs text-soft">${__( 'Em resolução' )}</p>
            </article>
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-soft">${__( 'Pendente Orçamento' )}</p>
                <h3 class="mt-3 text-3xl font-black text-purple-500">${data.waiting_budget_tickets || 0}</h3>
                <p class="mt-2 text-xs text-soft">${__( 'Aguardam aprovação' )}</p>
            </article>
            <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-soft">${__( 'Concluídos' )}</p>
                <h3 class="mt-3 text-3xl font-black text-emerald-500">${data.closed_tickets || 0}</h3>
                <p class="mt-2 text-xs text-soft">${__( 'Intervenções finalizadas' )}</p>
            </article>
        `;

                    document.getElementById('metricMttr').innerText = data.average_resolution_human || '0h 0m';
                    document.getElementById('metricWaiting').innerText = data.average_waiting_human || '0h 0m';
                    document.getElementById('metricSla').innerText = (data.sla_success || 100) + '%';

                    if (data.system_availability) {
                        document.getElementById('metricAvailability').innerText = data.system_availability + '%';
                    }

                    // 3. Renderizar Gráfico de Estados
                    if (charts.status) charts.status.destroy();
                    charts.status = new Chart(document.getElementById('statusChart'), {
                        type: 'bar',
                        data: {
                            labels: data.ticket_status_breakdown.labels,
                            datasets: [{
                                label: __( 'Quantidade' ),
                                data: data.ticket_status_breakdown.data,
                                backgroundColor: ['#f59e0b', '#3b82f6', '#a855f7', '#10b981'],
                                borderRadius: 12
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // 4. Renderizar Gráfico de Prioridades
                    if (charts.priority) charts.priority.destroy();
                    charts.priority = new Chart(document.getElementById('equipmentChart'), {
                        type: 'doughnut',
                        data: {
                            labels: data.by_priority.labels,
                            datasets: [{
                                data: data.by_priority.data,
                                backgroundColor: ['#10b981', '#f59e0b', '#f97316', '#ef4444'],
                                borderWidth: 2,
                                borderColor: 'transparent'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // 5. Renderizar Gráfico de Evolução
                    if (charts.trend) charts.trend.destroy();
                    charts.trend = new Chart(document.getElementById('trendChart'), {
                        type: 'line',
                        data: {
                            labels: data.monthly_tickets.labels,
                            datasets: [{
                                    label: __( 'Abertos' ),
                                    data: data.monthly_tickets.open,
                                    borderColor: '#f59e0b',
                                    tension: 0.3
                                },
                                {
                                    label: __( 'Em Curso' ),
                                    data: data.monthly_tickets.in_progress,
                                    borderColor: '#3b82f6',
                                    tension: 0.3
                                },
                                {
                                    label: __( 'Fechados' ),
                                    data: data.monthly_tickets.closed,
                                    borderColor: '#10b981',
                                    tension: 0.3
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // 6. Renderizar Gráfico de Custos
                    if (charts.cost) charts.cost.destroy();
                    charts.cost = new Chart(document.getElementById('costChart'), {
                        type: 'bar',
                        data: {
                            labels: data.monthly_cost.labels,
                            datasets: [{
                                label: __( 'Custo (€)' ),
                                data: data.monthly_cost.data,
                                backgroundColor: '#ea580c',
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // 7. Renderizar Rankings
                    renderRanking('topEquipments', data.top_equipments || data.top_equipment);
                    renderRanking('topRooms', data.top_rooms);
                    renderRanking('topTechnicians', data.top_technicians);

                    // 8. Renderizar Atividade Recente
                    if (data.recent_activity && data.recent_activity.length > 0) {
                        document.getElementById('activityTimeline').innerHTML = data.recent_activity.map(act => `
                <div class="flex items-start gap-4 p-5">
                    <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary font-bold">📌</div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold">${act.title}</h4>
                            <span class="text-[10px] text-soft">${act.time}</span>
                        </div>
                        <p class="mt-1 text-xs text-soft">${__( act.description )}</p>
                    </div>
                </div>
            `).join('');
                    } else {
                        document.getElementById('activityTimeline').innerHTML =
                            `<p class="p-6 text-xs text-soft italic">${__( 'Sem atividade recente registada.' )}</p>`;
                    }

                } catch (error) {
                    console.error('Erro ao carregar Analytics:', error);
                    const msg = document.getElementById('analyticsMessage');
                    if (msg) {
                        msg.innerText = __( 'Não foi possível carregar o relatório de analytics. Verifique a ligação ou privilégios.' );
                        msg.className =
                            'rounded-2xl border border-red-500/20 bg-red-500/10 text-red-600 px-5 py-4 text-sm font-medium';
                        msg.classList.remove('hidden');
                    }
                }
            }

            function renderRanking(elementId, items) {
                const container = document.getElementById(elementId);
                if (!container) return;

                if (!items || items.length === 0) {
                    container.innerHTML = `<p class="p-6 text-xs text-soft italic">${__( 'Sem dados disponíveis.' )}</p>`;
                    return;
                }

                container.innerHTML = items.map((item, idx) => `
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center gap-3">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[var(--surface-2)] text-xs font-bold">${idx + 1}</span>
                <div>
                    <p class="text-xs font-bold">${item.name}</p>
                    <p class="text-[10px] text-soft">${__( item.subtitle || '' )}</p>
                </div>
            </div>
            <span class="text-xs font-black text-primary">${item.total}</span>
        </div>
    `).join('');
            }

            document.addEventListener('DOMContentLoaded', loadAnalytics);
        </script>
    @endpush
@endsection