@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Tickets',
    'subtitle' => 'Pesquise, filtre e consulte as ocorrências registadas.',
    'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> Voltar ao painel</a><a href="/ui/tickets/create" class="inline-flex items-center justify-center px-3 py-1.5 bg-primary text-xs font-semibold text-black rounded-xl shadow-sm hover:opacity-90 transition-all">+ Criar Ticket</a></div>'
])

    {{-- Painel de Pesquisa Avançada Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Termo de Pesquisa</label>
                <div class="relative">
                    <input id="filter_q" placeholder="Pesquisar em título e descrição do ticket..."
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all">
                </div>
            </div>

            <div>
                <label for="filter_status" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Estado</label>
                <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                    <option value="">Todos</option>
                    <option value="aberta">Aberta</option>
                    <option value="em curso">Em Curso</option>
                    <option value="fechada">Fechada</option>
                </select>
            </div>

            <div>
                <label for="filter_priority" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Prioridade</label>
                <select id="filter_priority" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                    <option value="">Todas</option>
                    <option value="baixa">Baixa</option>
                    <option value="média">Média</option>
                    <option value="alta">Alta</option>
                    <option value="crítica">Crítica</option>
                </select>
            </div>

            <div>
                <label for="filter_date_from" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Data de abertura (De)</label>
                <input id="filter_date_from" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
            </div>

            <div>
                <label for="filter_date_to" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Data até</label>
                <input id="filter_date_to" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-4 py-2 bg-primary text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                    Pesquisar
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-4 py-2 bg-primary text-xs font-semibold text-[var(--surface)] border border-primary/50 rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                    Limpar filtros
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="Lista de tickets">
        <div class="overflow-x-auto">
            <table id="ticketsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-3.5 font-bold">ID</th>
                        <th class="px-5 py-3.5 font-bold">Título</th>
                        <th class="px-5 py-3.5 font-bold">Prioridade</th>
                        <th class="px-5 py-3.5 font-bold">Estado</th>
                        <th class="px-5 py-3.5 font-bold">Equipamento</th>
                        <th class="px-5 py-3.5 font-bold">Sala</th>
                        <th class="px-5 py-3.5 font-bold">Técnico</th>
                        <th class="px-5 py-3.5 font-bold text-right">Ações</th>
                    </tr>
                </thead>
                <tbody id="ticketsBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                A carregar listagem de tickets...
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Área de Paginação Alinhada --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent
@endsection

@push('scripts')
<script>
// Mapeamento premium e sutil de cores para as prioridades (Estilo Badges Minimalistas)
const priorityColors = {
    baixa:   'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média:   'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta:    'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-rose-500/20 bg-rose-500/5 text-rose-600 dark:text-rose-400',
};

let currentPage = 1;

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

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

    const endpoint = q || dateFrom || dateTo ? '/tickets/search' : '/tickets';

    const tbody = document.getElementById('ticketsBody');
    tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>`;

    const res = await fetch(`${endpoint}?${params.toString()}`, { headers: authHeader() });
    if (res.status === 401) { showFeedback('Autenticação necessária. Faça login.', true); window.location = '/ui/login'; return; }
    if (!res.ok) { showFeedback('Não foi possível carregar os tickets de momento.', true); return; }
    const data = await res.json().catch(() => ({}));

    const tickets = data.tickets?.data ?? data.tickets ?? [];
    const meta    = data.tickets?.meta ?? data.tickets ?? {};
    const total   = meta.total ?? tickets.length;

    document.getElementById('resultsCount').textContent = total > 0 ? `${total} resultado(s) encontrado(s)` : 'Sem resultados';

    if (!tickets.length) {
        tbody.innerHTML = '<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum ticket encontrado com os filtros aplicados.</div></td></tr>';
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    tbody.innerHTML = tickets.map(t => {
        const priColor = priorityColors[t.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
        const statusName = t.status?.name ?? t.status ?? 'N/A';

        // Customização visual dinâmica para o Estado do Ticket
        let statusBadge = `<span class="inline-flex items-center gap-1.5 font-bold text-[var(--text)] text-[11px] uppercase tracking-tight">${statusName}</span>`;
        if(statusName.toLowerCase() === 'aberta' || statusName.toLowerCase() === 'aberto') {
            statusBadge = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">Aberta</span>`;
        } else if (statusName.toLowerCase() === 'em curso') {
            statusBadge = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 uppercase tracking-tight">Em Curso</span>`;
        } else if (statusName.toLowerCase() === 'fechada' || statusName.toLowerCase() === 'fechado') {
            statusBadge = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight">Fechada</span>`;
        }

        return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
            <td class="px-5 py-3.5 font-mono text-[var(--text-soft)] font-bold">#${t.id}</td>
            <td class="px-5 py-3.5 font-semibold text-[var(--text)] max-w-xs truncate" title="${t.title}">${t.title}</td>
            <td class="px-5 py-3.5">
                <span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold uppercase tracking-tight ${priColor}">${t.priority}</span>
            </td>
            <td class="px-5 py-3.5">${statusBadge}</td>
            <td class="px-5 py-3.5 text-[var(--text-soft)] font-semibold">${t.equipment ? t.equipment.name : '—'}</td>
            <td class="px-5 py-3.5 text-[var(--text-soft)] font-semibold">${t.room ? t.room.name : '—'}</td>
            <td class="px-5 py-3.5 text-xs font-semibold text-[var(--text)]">${t.technician ? t.technician.name : '<span class="text-[var(--text-soft)] font-normal italic">—</span>'}</td>
            <td class="px-5 py-3.5 text-right">
                <a href="/ui/tickets/${t.id}" class="inline-flex items-center justify-center px-2.5 py-1 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all">Ver</a>
            </td>
        </tr>`;
    }).join('');

    // Renderização do Bloco de Paginação Estilizado
    const lastPage  = meta.last_page ?? 1;
    const currPage  = meta.current_page ?? page;
    const pagEl     = document.getElementById('pagination');
    if (lastPage <= 1) { pagEl.innerHTML = ''; return; }
    pagEl.innerHTML = `
        <button onclick="loadTickets(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center px-3 py-1.5 bg-primary text-xs font-semibold text-[var(--surface)] border border-primary/50 rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
        <button onclick="loadTickets(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
            class="inline-flex items-center justify-center px-3 py-1.5 bg-primary text-xs font-semibold text-[var(--surface)] border border-primary/50 rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed">Próxima →</button>
    `;
}

function showFeedback(message, error = false) {
    const el = document.getElementById('resultsCount');
    if (!el) return;
    el.textContent = message;
    el.className = `text-xs font-semibold ${error ? 'text-red-600 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

document.getElementById('btnSearch').addEventListener('click', () => loadTickets(1));

document.getElementById('btnClear').addEventListener('click', () => {
    ['filter_q','filter_status','filter_priority','filter_date_from','filter_date_to'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    loadTickets(1);
});

document.getElementById('filter_q').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadTickets(1);
});

window.addEventListener('load', () => loadTickets(1));
</script>
@endpush
