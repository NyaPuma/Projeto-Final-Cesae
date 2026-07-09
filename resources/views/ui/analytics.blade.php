@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>
@component('ui.partials.page-card', [
    'title' => 'Analytics & Relatórios',
    'subtitle' => 'Indicadores de desempenho, gráficos e exportação de relatórios.',
    'actions' => '<div class="flex flex-wrap gap-2">
        <a href="/analytics/export/csv" id="btnExportCsv" class="rounded-full border border-emerald-400/30 bg-emerald-500/10 px-4 py-2 text-sm font-medium text-emerald-300 transition hover:bg-emerald-500/20">⬇ CSV</a>
        <a href="/analytics/export/pdf" id="btnExportPdf" class="rounded-full border border-rose-400/30 bg-rose-500/10 px-4 py-2 text-sm font-medium text-rose-300 transition hover:bg-rose-500/20">⬇ PDF</a>
        <a href="/analytics/export/excel" id="btnExportExcel" class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-4 py-2 text-sm font-medium text-cyan-300 transition hover:bg-cyan-500/20">⬇ Excel</a>
    </div>'
])
    {{-- KPI Cards --}}
    <div id="kpiPanel" class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="col-span-full flex items-center justify-center py-8 text-slate-400">
            <svg class="mr-3 h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            A carregar indicadores...
        </div>
    </div>

    {{-- Charts grid --}}
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-5">
            <h3 class="mb-4 text-base font-semibold text-white">Tickets por Mês (Abertos vs. Fechados)</h3>
            <canvas id="chartMonthly" height="220"></canvas>
        </div>
        <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-5">
            <h3 class="mb-4 text-base font-semibold text-white">Distribuição por Prioridade</h3>
            <canvas id="chartPriority" height="220"></canvas>
        </div>
        <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-5">
            <h3 class="mb-4 text-base font-semibold text-white">Custo Mensal de Reparações (€)</h3>
            <canvas id="chartCost" height="220"></canvas>
        </div>
        <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-5">
            <h3 class="mb-4 text-base font-semibold text-white">Top 5 Equipamentos com Mais Tickets</h3>
            <canvas id="chartEquipment" height="220"></canvas>
        </div>
    </div>
@endcomponent
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Paleta de cores consistente com o design do sistema
const COLORS = {
    cyan:    'rgba(34,211,238,0.85)',
    cyanBg:  'rgba(34,211,238,0.15)',
    rose:    'rgba(251,113,133,0.85)',
    roseBg:  'rgba(251,113,133,0.15)',
    amber:   'rgba(251,191,36,0.85)',
    amberBg: 'rgba(251,191,36,0.15)',
    violet:  'rgba(167,139,250,0.85)',
    violetBg:'rgba(167,139,250,0.15)',
    emerald: 'rgba(52,211,153,0.85)',
    emeraldBg:'rgba(52,211,153,0.15)',
};

const chartDefaults = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { labels: { color: '#94a3b8', font: { size: 12 } } },
    },
    scales: {
        x: { ticks: { color: '#64748b' }, grid: { color: 'rgba(255,255,255,0.05)' } },
        y: { ticks: { color: '#64748b' }, grid: { color: 'rgba(255,255,255,0.05)' }, beginAtZero: true },
    },
};

async function loadKPIs() {
    const res = await fetch('/analytics', { headers: authHeader() });
    if (!res.ok) return;
    const data = await res.json();

    const kpis = [
        { label: 'MTTR (Resolução)', value: `${Math.round(data.average_resolution_minutes ?? 0)} min`, icon: '⏱', color: 'cyan' },
        { label: 'Espera Média', value: `${Math.round(data.average_waiting_minutes ?? 0)} min`, icon: '⌛', color: 'amber' },
        { label: 'Tickets em Aberto', value: data.open_tickets ?? 0, icon: '🔴', color: 'rose' },
        { label: 'Tickets Fechados', value: data.closed_tickets ?? 0, icon: '✅', color: 'emerald' },
    ];

    const colorMap = {
        cyan:    'border-cyan-400/20 bg-cyan-500/10 text-cyan-300',
        amber:   'border-amber-400/20 bg-amber-500/10 text-amber-300',
        rose:    'border-rose-400/20 bg-rose-500/10 text-rose-300',
        emerald: 'border-emerald-400/20 bg-emerald-500/10 text-emerald-300',
    };

    document.getElementById('kpiPanel').innerHTML = kpis.map(k => `
        <div class="rounded-2xl border ${colorMap[k.color]} p-5 transition hover:scale-[1.02]">
            <p class="text-2xl">${k.icon}</p>
            <p class="mt-2 text-3xl font-bold text-white">${k.value}</p>
            <p class="mt-1 text-sm text-slate-400">${k.label}</p>
        </div>
    `).join('');
}

async function loadCharts() {
    const res = await fetch('/analytics/charts', { headers: authHeader() });
    if (!res.ok) return;
    const d = await res.json();

    // --- Gráfico 1: Tickets por Mês ---
    new Chart(document.getElementById('chartMonthly'), {
        type: 'bar',
        data: {
            labels: d.monthly_tickets.labels,
            datasets: [
                {
                    label: 'Abertos',
                    data: d.monthly_tickets.open,
                    backgroundColor: COLORS.cyanBg,
                    borderColor: COLORS.cyan,
                    borderWidth: 2,
                    borderRadius: 6,
                },
                {
                    label: 'Fechados',
                    data: d.monthly_tickets.closed,
                    backgroundColor: COLORS.roseBg,
                    borderColor: COLORS.rose,
                    borderWidth: 2,
                    borderRadius: 6,
                },
            ],
        },
        options: { ...chartDefaults, plugins: { ...chartDefaults.plugins, title: { display: false } } },
    });

    // --- Gráfico 2: Distribuição por Prioridade (Doughnut) ---
    const priorityColors = [COLORS.rose, COLORS.amber, COLORS.cyan, COLORS.violet, COLORS.emerald];
    new Chart(document.getElementById('chartPriority'), {
        type: 'doughnut',
        data: {
            labels: d.by_priority.labels,
            datasets: [{
                data: d.by_priority.data,
                backgroundColor: priorityColors.slice(0, d.by_priority.labels.length),
                borderColor: 'rgba(15,23,42,0.8)',
                borderWidth: 3,
                hoverOffset: 8,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { color: '#94a3b8', padding: 16, font: { size: 12 } } },
            },
        },
    });

    // --- Gráfico 3: Custo Mensal (Line) ---
    new Chart(document.getElementById('chartCost'), {
        type: 'line',
        data: {
            labels: d.monthly_cost.labels,
            datasets: [{
                label: 'Custo Total (€)',
                data: d.monthly_cost.data,
                borderColor: COLORS.emerald,
                backgroundColor: COLORS.emeraldBg,
                borderWidth: 2.5,
                pointBackgroundColor: COLORS.emerald,
                pointRadius: 5,
                fill: true,
                tension: 0.4,
            }],
        },
        options: { ...chartDefaults },
    });

    // --- Gráfico 4: Top Equipamentos (Horizontal Bar) ---
    new Chart(document.getElementById('chartEquipment'), {
        type: 'bar',
        data: {
            labels: d.top_equipment.labels,
            datasets: [{
                label: 'Nº de Tickets',
                data: d.top_equipment.data,
                backgroundColor: COLORS.violetBg,
                borderColor: COLORS.violet,
                borderWidth: 2,
                borderRadius: 6,
            }],
        },
        options: {
            ...chartDefaults,
            indexAxis: 'y',
            scales: {
                x: { ticks: { color: '#64748b' }, grid: { color: 'rgba(255,255,255,0.05)' }, beginAtZero: true },
                y: { ticks: { color: '#64748b' }, grid: { display: false } },
            },
        },
    });
}

// Adicionar token de autenticação nas ligações de exportação
function setupExportLinks() {
    const token = localStorage.getItem('api_token');
    if (!token) return;
    ['btnExportCsv','btnExportPdf','btnExportExcel'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            const url = new URL(el.href, window.location.origin);
            // Para downloads autenticados, redirecionar com cookie (já configurado no login)
            // O token é enviado via cookie api_token pela lógica do layout
        }
    });
}

window.addEventListener('load', () => {
    loadKPIs();
    loadCharts();
    setupExportLinks();
});
</script>
@endpush
