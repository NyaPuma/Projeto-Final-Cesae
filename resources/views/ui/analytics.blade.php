@extends('ui.layout')

@section('content')
    <script>
        window.requireAuthOnLoad = true;
    </script>

    @component('ui.partials.page-card', [
        'title' => 'Analytics',
        'subtitle' => 'Indicadores operacionais, desempenho da infraestrutura, custos e relatórios executivos em tempo real.',
        'actions' => '
            <div class="flex flex-wrap gap-2">
                <a href="/analytics/export/csv" id="btnExportCsv" class="btn btn-secondary">
                    Exportar CSV
                </a>

                <a href="/analytics/export/pdf" id="btnExportPdf" class="btn btn-secondary">
                    Exportar PDF
                </a>

                <a href="/analytics/export/excel" id="btnExportExcel" class="btn btn-primary">
                    Exportar Excel
                </a>
            </div>
        ',
    ])
        <div class="space-y-10">

            {{-- KPIs --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">
                            Indicadores principais
                        </h2>
                        <p class="text-sm text-soft mt-1">
                            Estado atual da plataforma e desempenho operacional.
                        </p>
                    </div>
                    <span class="badge">
                        Tempo Real
                    </span>
                </div>

                <div id="kpiPanel" class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="card p-8 col-span-full">
                        <div class="flex items-center justify-center py-12">
                            <svg class="w-5 h-5 animate-spin opacity-70 mr-3" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle>
                                <path fill="currentColor" class="opacity-80" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path>
                            </svg>
                            <span class="text-soft text-sm">
                                A carregar métricas...
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Gráficos --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">
                            Visualizações
                        </h2>
                        <p class="text-sm text-soft mt-1">
                            Estatísticas agregadas do sistema.
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold">
                                    Tickets Mensais
                                </h3>
                                <p class="text-soft text-sm mt-1">
                                    Abertos vs encerrados
                                </p>
                            </div>
                            <span class="badge">
                                Histórico
                            </span>
                        </div>
                        <div class="h-[320px]">
                            <canvas id="chartMonthly"></canvas>
                        </div>
                    </div>

                    <div class="card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold">
                                    Prioridades
                                </h3>
                                <p class="text-soft text-sm mt-1">
                                    Distribuição atual
                                </p>
                            </div>
                            <span class="badge">
                                Criticidade
                            </span>
                        </div>
                        <div class="h-[320px]">
                            <canvas id="chartPriority"></canvas>
                        </div>
                    </div>

                    <div class="card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold">
                                    Custos de Reparação
                                </h3>
                                <p class="text-soft text-sm mt-1">
                                    Evolução mensal dos custos
                                </p>
                            </div>
                            <span class="badge">
                                Financeiro
                            </span>
                        </div>
                        <div class="h-[320px]">
                            <canvas id="chartCost"></canvas>
                        </div>
                    </div>

                    <div class="card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold">
                                    Equipamentos
                                </h3>
                                <p class="text-soft text-sm mt-1">
                                    Top equipamentos com mais ocorrências
                                </p>
                            </div>
                            <span class="badge">
                                Top 5
                            </span>
                        </div>
                        <div class="h-[320px]">
                            <canvas id="chartEquipment"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endcomponent
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        const isDark =
            document.documentElement.classList.contains("dark") ||
            window.matchMedia("(prefers-color-scheme: dark)").matches;

        const COLORS = {
            text: isDark ? "#F8F8F8" : "#171717",
            soft: isDark ? "#9CA3AF" : "#6B7280",
            border: isDark ? "rgba(255,255,255,.08)" : "rgba(0,0,0,.08)",
            grid: isDark ? "rgba(255,255,255,.06)" : "rgba(0,0,0,.06)",
            primary: "#f59e0b",
            secondary: "#fb923c",
            tertiary: "#fcd34d",
        };

        // Tipografia ajustada conforme a inclusão de fontes bunny do layout global
        Chart.defaults.font.family = "Inter, sans-serif";
        Chart.defaults.color = COLORS.soft;
        Chart.defaults.borderColor = COLORS.border;

        const chartDefaults = {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 700
            },
            plugins: {
                legend: {
                    labels: {
                        color: COLORS.soft,
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 18,
                        font: {
                            size: 12,
                            weight: "600"
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: COLORS.soft
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: COLORS.grid
                    },
                    ticks: {
                        color: COLORS.soft
                    }
                }
            }
        };

        async function loadKPIs() {
            try {
                const response = await fetch("/analytics", {
                    headers: authHeader()
                });

                if (!response.ok) return;

                const data = await response.json();

                const kpis = [
                    {
                        label: "MTTR",
                        value: `${Math.round(data.average_resolution_minutes ?? 0)} min`,
                        detail: "Tempo médio de resolução"
                    },
                    {
                        label: "Espera Média",
                        value: `${Math.round(data.average_waiting_minutes ?? 0)} min`,
                        detail: "Tempo até atribuição"
                    },
                    {
                        label: "Tickets Abertos",
                        value: data.open_tickets ?? 0,
                        detail: "Ocorrências ativas"
                    },
                    {
                        label: "Tickets Fechados",
                        value: data.closed_tickets ?? 0,
                        detail: "Concluídos"
                    }
                ];

                document.getElementById("kpiPanel").innerHTML = kpis.map(kpi => `
                    <div class="card p-7">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.18em] text-soft">
                                    ${kpi.label}
                                </p>
                                <h3 class="text-4xl font-black mt-3">
                                    ${kpi.value}
                                </h3>
                                <p class="text-sm text-soft mt-3">
                                    ${kpi.detail}
                                </p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20"></div>
                        </div>
                    </div>
                `).join("");

            } catch {
                document.getElementById("kpiPanel").innerHTML = `
                    <div class="card p-10 col-span-full text-center">
                        <h3 class="font-bold">
                            Não foi possível carregar os indicadores.
                        </h3>
                    </div>
                `;
            }
        }

        async function loadCharts() {
            try {
                const response = await fetch("/analytics/charts", {
                    headers: authHeader()
                });

                if (!response.ok) throw new Error("Erro na resposta da API");

                const d = await response.json();

                new Chart(
                    document.getElementById("chartMonthly"),
                    {
                        type: "bar",
                        data: {
                            labels: d.monthly_tickets.labels,
                            datasets: [
                                {
                                    label: "Abertos",
                                    data: d.monthly_tickets.open,
                                    backgroundColor: COLORS.primary,
                                    borderRadius: 8
                                },
                                {
                                    label: "Fechados",
                                    data: d.monthly_tickets.closed,
                                    backgroundColor: COLORS.secondary,
                                    borderRadius: 8
                                }
                            ]
                        },
                        options: chartDefaults
                    }
                );

                new Chart(
                    document.getElementById("chartPriority"),
                    {
                        type: "doughnut",
                        data: {
                            labels: d.by_priority.labels,
                            datasets: [{
                                data: d.by_priority.data,
                                backgroundColor: [
                                    COLORS.primary,
                                    COLORS.secondary,
                                    COLORS.tertiary,
                                    "#fb7185",
                                    "#818cf8"
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: "68%",
                            plugins: {
                                legend: {
                                    position: "bottom",
                                    labels: {
                                        color: COLORS.soft,
                                        usePointStyle: true
                                    }
                                }
                            }
                        }
                    }
                );

                new Chart(
                    document.getElementById("chartCost"),
                    {
                        type: "line",
                        data: {
                            labels: d.monthly_cost.labels,
                            datasets: [{
                                label: "Custo (€)",
                                data: d.monthly_cost.data,
                                borderColor: COLORS.primary,
                                backgroundColor: "rgba(245,158,11,.12)",
                                fill: true,
                                tension: .35,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBackgroundColor: COLORS.primary
                            }]
                        },
                        options: chartDefaults
                    }
                );

                new Chart(
                    document.getElementById("chartEquipment"),
                    {
                        type: "bar",
                        data: {
                            labels: d.top_equipment.labels,
                            datasets: [{
                                label: "Incidências",
                                data: d.top_equipment.data,
                                backgroundColor: COLORS.secondary,
                                borderRadius: 8
                            }]
                        },
                        options: {
                            ...chartDefaults,
                            indexAxis: "y"
                        }
                    }
                );
            } catch (error) {
                console.error("Erro ao desenhar gráficos:", error);
                ['chartMonthly', 'chartPriority', 'chartCost', 'chartEquipment'].forEach(id => {
                    const canvas = document.getElementById(id);
                    if (canvas && canvas.parentElement) {
                        canvas.parentElement.innerHTML = `
                            <div class="flex items-center justify-center h-full text-soft text-sm">
                                Não foi possível carregar as visualizações deste gráfico.
                            </div>
                        `;
                    }
                });
            }
        }

        // Intercepta e processa os pedidos de exportação injetando o X-Auth-Token obrigatório
        function setupExportLinks() {
            const token = localStorage.getItem("api_token");
            if (!token) return;

            ['btnExportCsv', 'btnExportPdf', 'btnExportExcel'].forEach(id => {
                const btn = document.getElementById(id);
                if (!btn) return;

                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const url = btn.getAttribute('href');
                    const originalText = btn.innerHTML;

                    btn.innerHTML = `<span class="inline-block animate-spin mr-1">⏳</span>`;
                    btn.style.pointerEvents = 'none';

                    try {
                        const response = await fetch(url, {
                            headers: authHeader()
                        });

                        if (!response.ok) throw new Error('Erro na exportação');

                        const blob = await response.blob();
                        const downloadUrl = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = downloadUrl;

                        let filename = 'export_' + new Date().toISOString().slice(0, 10);
                        if (id === 'btnExportCsv') filename += '.csv';
                        else if (id === 'btnExportPdf') filename += '.pdf';
                        else filename += '.xlsx';

                        const disposition = response.headers.get('content-disposition');
                        if (disposition && disposition.includes('filename=')) {
                            const matched = disposition.match(/filename="?([^";\n]+)"?/);
                            if (matched && matched[1]) filename = matched[1];
                        }

                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(downloadUrl);
                    } catch (error) {
                        alert('Não foi possível exportar o ficheiro. Por favor, tente novamente.');
                        console.error(error);
                    } finally {
                        btn.innerHTML = originalText;
                        btn.style.pointerEvents = 'auto';
                    }
                });
            });
        }

        window.addEventListener("DOMContentLoaded", () => {
            loadKPIs();
            loadCharts();
            setupExportLinks();
        });
    </script>
@endpush
