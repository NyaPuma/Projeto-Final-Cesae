@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>
@component('ui.partials.page-card', [
    'title' => 'Tickets',
    'subtitle' => 'Pesquise, filtre e consulte as ocorrências registadas.',
    'actions' => '<a href="/ui" class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-4 py-2 text-sm font-medium text-cyan-300 transition hover:bg-cyan-500/20">← Voltar ao painel</a>'
])
    {{-- Painel de Pesquisa Avançada --}}
    <div class="mb-6 rounded-2xl border border-white/10 bg-slate-950/60 p-4">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <label class="text-sm text-slate-300 sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <span class="sr-only">Pesquisa de texto</span>
                <input id="filter_q" placeholder="🔍  Pesquisar em título e descrição..."
                    class="w-full rounded-xl border border-slate-700 bg-slate-900/80 px-4 py-2.5 text-sm text-white outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/30">
            </label>
            <label class="text-sm text-slate-300">Estado
                <select id="filter_status" class="mt-1 w-full rounded-xl border border-slate-700 bg-slate-900/80 px-3 py-2 text-sm text-white outline-none focus:border-cyan-500">
                    <option value="">Todos</option>
                    <option value="aberta">Aberta</option>
                    <option value="em curso">Em Curso</option>
                    <option value="fechada">Fechada</option>
                </select>
            </label>
            <label class="text-sm text-slate-300">Prioridade
                <select id="filter_priority" class="mt-1 w-full rounded-xl border border-slate-700 bg-slate-900/80 px-3 py-2 text-sm text-white outline-none focus:border-cyan-500">
                    <option value="">Todas</option>
                    <option value="baixa">Baixa</option>
                    <option value="média">Média</option>
                    <option value="alta">Alta</option>
                    <option value="crítica">Crítica</option>
                </select>
            </label>
            <label class="text-sm text-slate-300">Data de (abertura)
                <input id="filter_date_from" type="date" class="mt-1 w-full rounded-xl border border-slate-700 bg-slate-900/80 px-3 py-2 text-sm text-white outline-none focus:border-cyan-500">
            </label>
            <label class="text-sm text-slate-300">Data até
                <input id="filter_date_to" type="date" class="mt-1 w-full rounded-xl border border-slate-700 bg-slate-900/80 px-3 py-2 text-sm text-white outline-none focus:border-cyan-500">
            </label>
        </div>
        <div class="mt-3 flex flex-wrap items-center gap-2">
            <button id="btnSearch" class="rounded-xl bg-cyan-500 px-5 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">Pesquisar</button>
            <button id="btnClear" class="rounded-xl border border-slate-600 bg-slate-800 px-5 py-2 text-sm font-medium text-slate-300 transition hover:bg-slate-700">Limpar filtros</button>
            <span id="resultsCount" class="ml-auto text-xs text-slate-400"></span>
        </div>
    </div>

    {{-- Tabela de Resultados --}}
    <div class="overflow-x-auto rounded-2xl border border-white/10 bg-slate-950/60">
        <table id="ticketsTable" class="min-w-full divide-y divide-white/10 text-sm text-slate-300">
            <thead class="bg-slate-900/80 text-left text-slate-200">
                <tr>
                    <th class="px-4 py-3 font-semibold">ID</th>
                    <th class="px-4 py-3 font-semibold">Título</th>
                    <th class="px-4 py-3 font-semibold">Prioridade</th>
                    <th class="px-4 py-3 font-semibold">Estado</th>
                    <th class="px-4 py-3 font-semibold">Equipamento</th>
                    <th class="px-4 py-3 font-semibold">Sala</th>
                    <th class="px-4 py-3 font-semibold">Técnico</th>
                    <th class="px-4 py-3 font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody id="ticketsBody">
                <tr><td colspan="8" class="px-4 py-8 text-center text-slate-400">A carregar tickets...</td></tr>
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div id="pagination" class="mt-4 flex items-center justify-between text-sm text-slate-400"></div>
@endcomponent
@endsection

@push('scripts')
<script>
const priorityColors = {
    baixa:   'bg-emerald-500/20 text-emerald-300',
    média:   'bg-amber-500/20   text-amber-300',
    alta:    'bg-orange-500/20  text-orange-300',
    crítica: 'bg-rose-500/20    text-rose-300',
};

let currentPage = 1;

async function loadTickets(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q          = document.getElementById('filter_q').value.trim();
    const status     = document.getElementById('filter_status').value;
    const priority   = document.getElementById('filter_priority').value;
    const dateFrom   = document.getElementById('filter_date_from').value;
    const dateTo     = document.getElementById('filter_date_to').value;

    if (q)        params.append('q', q);
    if (status)   params.append('status', status);
    if (priority) params.append('priority', priority);
    if (dateFrom) params.append('date_from', dateFrom);
    if (dateTo)   params.append('date_to', dateTo);
    params.append('page', page);

    // Usar o endpoint de pesquisa avançada se existir query, senão o index
    const endpoint = q || dateFrom || dateTo ? '/tickets/search' : '/tickets';

    const tbody = document.getElementById('ticketsBody');
    tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-8 text-center text-slate-400">A carregar...</td></tr>';

    const res = await fetch(`${endpoint}?${params.toString()}`, { headers: authHeader() });
    if (res.status === 401) { alert('Autenticação necessária. Faça login.'); window.location = '/ui/login'; return; }
    const data = await res.json();

    const tickets = data.tickets?.data ?? data.tickets ?? [];
    const meta    = data.tickets?.meta ?? data.tickets ?? {};
    const total   = meta.total ?? tickets.length;

    document.getElementById('resultsCount').textContent = total > 0 ? `${total} resultado(s)` : 'Sem resultados';

    if (!tickets.length) {
        tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-8 text-center text-slate-400">Nenhum ticket encontrado.</td></tr>';
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    tbody.innerHTML = tickets.map(t => {
        const priColor = priorityColors[t.priority] ?? 'bg-slate-700 text-slate-300';
        const statusName = t.status?.name ?? t.status ?? 'N/A';
        return `<tr class="border-t border-white/5 hover:bg-slate-800/30 transition-colors">
            <td class="px-4 py-3 font-mono text-xs text-slate-400">#${t.id}</td>
            <td class="px-4 py-3 font-medium text-white max-w-xs truncate" title="${t.title}">${t.title}</td>
            <td class="px-4 py-3">
                <span class="rounded-full px-2 py-0.5 text-xs font-semibold ${priColor}">${t.priority}</span>
            </td>
            <td class="px-4 py-3 text-xs">${statusName}</td>
            <td class="px-4 py-3 text-xs">${t.equipment ? t.equipment.name : '—'}</td>
            <td class="px-4 py-3 text-xs">${t.room ? t.room.name : '—'}</td>
            <td class="px-4 py-3 text-xs">${t.technician ? t.technician.name : '—'}</td>
            <td class="px-4 py-3">
                <a href="/ui/tickets/${t.id}" class="rounded-lg border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-medium text-cyan-300 transition hover:bg-cyan-500/20">Ver</a>
            </td>
        </tr>`;
    }).join('');

    // Render pagination
    const lastPage  = meta.last_page ?? 1;
    const currPage  = meta.current_page ?? page;
    const pagEl     = document.getElementById('pagination');
    if (lastPage <= 1) { pagEl.innerHTML = ''; return; }
    pagEl.innerHTML = `
        <button onclick="loadTickets(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
            class="rounded-lg border border-white/10 px-3 py-1 text-xs transition hover:bg-white/10 disabled:opacity-40 disabled:cursor-not-allowed">← Anterior</button>
        <span>Página ${currPage} de ${lastPage}</span>
        <button onclick="loadTickets(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
            class="rounded-lg border border-white/10 px-3 py-1 text-xs transition hover:bg-white/10 disabled:opacity-40 disabled:cursor-not-allowed">Próxima →</button>
    `;
}

document.getElementById('btnSearch').addEventListener('click', () => loadTickets(1));

document.getElementById('btnClear').addEventListener('click', () => {
    ['filter_q','filter_status','filter_priority','filter_date_from','filter_date_to'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    loadTickets(1);
});

// Pesquisa ao pressionar Enter no campo de texto
document.getElementById('filter_q').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadTickets(1);
});

window.addEventListener('load', () => loadTickets(1));
</script>
@endpush
