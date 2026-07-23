@extends('ui.layout')

@section('content')
<script>
// Garante que o utilizador está autenticado antes de carregar o conteúdo da página
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Auditoria'),
    'subtitle' => __('Monitorização completa das operações efetuadas pelos utilizadores e pelos processos automáticos do sistema.'),
    'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel') . '</a></div>'
])

    {{-- Painel de Pesquisa Avançada Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2 lg:col-span-3">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Pesquisa Geral') }}</label>
                <div class="relative">
                    <input id="filter_q" placeholder="{{ __('Pesquise por utilizador, entidade, operação ou ID do log...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="filter_event" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Filtrar por Evento') }}</label>
                <select id="filter_event" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos os eventos') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="ui-button ui-button--primary inline-flex items-center justify-center px-4 py-2 text-[var(--on-primary)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="ui-button ui-button--outline inline-flex items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-500/10 text-amber-800 dark:text-amber-400 uppercase tracking-wider">
                    {{ __('Últimos 200 registos') }}
                </span>
                <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
            </div>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de auditoria') }}">
        <div class="overflow-x-auto">
            <table id="auditsTable" class="min-w-[1350px] w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Log') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Utilizador / Operador') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Entidade') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Referência') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Evento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Estado Anterior') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Novo Estado') }}</th>
                        <th class="px-5 py-4 text-right font-bold">{{ __('Data') }}</th>
                    </tr>
                </thead>
                <tbody id="auditsTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar registos de auditoria...') }}
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
let allAudits = [];
let filteredAudits = [];
let currentPage = 1;
const itemsPerPage = 10;

function authHeader(){
    const token = localStorage.getItem('auth_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

document.addEventListener('DOMContentLoaded', () => {
    fetchAudits();
    setupFilters();
});

async function fetchAudits() {
    const tbody = document.getElementById('auditsTableBody');
    try {
        const response = await window.api.get('/api/audits', {
            headers: authHeader()
        });

        allAudits = response.data || [];
        filteredAudits = [...allAudits];

        populateEventFilter(allAudits);
        applyFiltersAndRender(1);
    } catch (error) {
        console.error('Erro ao ir buscar a auditoria:', error);
        if (typeof window.showToast === 'function') {
            window.showToast("{{ __('Não foi possível carregar os registos de auditoria.') }}", 'error');
        }
        renderErrorState();
    }
}

function getEventBadge(event) {
    const value = String(event || "").toLowerCase().trim();

    if (value.includes('create') || value.includes('criar') || value.includes('insert')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">${"{{ __('Criar') }}"}</span>`;
    }
    if (value.includes('update') || value.includes('editar') || value.includes('atualizar')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-800 dark:text-amber-400 border border-amber-500/20 uppercase tracking-tight">${"{{ __('Editar') }}"}</span>`;
    }
    if (value.includes('delete') || value.includes('eliminar') || value.includes('remover')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-red-500/10 text-red-700 dark:text-red-400 border border-red-500/20 uppercase tracking-tight">${"{{ __('Eliminar') }}"}</span>`;
    }

    return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-[var(--surface-2)] text-[var(--text-soft)] border border-[var(--border)] uppercase tracking-tight">${event}</span>`;
}

function formatStateData(state) {
    if (!state) return `<span class="text-[var(--text-soft)] font-mono">-</span>`;

    if (typeof state === 'object') {
        return `<pre class="text-[10px] font-mono max-w-xs max-h-40 overflow-auto bg-[var(--surface-2)] p-2 rounded-xl text-[var(--text-soft)] border border-[var(--border)] leading-relaxed">${JSON.stringify(state, null, 2)}</pre>`;
    }

    try {
        const parsed = JSON.parse(state);
        return `<pre class="text-[10px] font-mono max-w-xs max-h-40 overflow-auto bg-[var(--surface-2)] p-2 rounded-xl text-[var(--text-soft)] border border-[var(--border)] leading-relaxed">${JSON.stringify(parsed, null, 2)}</pre>`;
    } catch (e) {
        return `<span class="text-xs font-mono break-all line-clamp-2 text-[var(--text-soft)]" title="${state}">${state}</span>`;
    }
}

function populateEventFilter(audits) {
    const eventSelect = document.getElementById('filter_event');
    if (!eventSelect) return;

    const uniqueEvents = [...new Set(audits.map(item => String(item.event || '').trim()))].filter(Boolean);

    eventSelect.innerHTML = `<option value="">${"{{ __('Todos os eventos') }}"}</option>`;

    uniqueEvents.forEach(ev => {
        const option = document.createElement('option');
        option.value = ev.toLowerCase();
        option.textContent = ev.charAt(0).toUpperCase() + ev.slice(1);
        eventSelect.appendChild(option);
    });
}

function setupFilters() {
    const searchInput = document.getElementById('filter_q');
    const eventSelect = document.getElementById('filter_event');

    const triggerFilter = () => {
        const query = (searchInput?.value || '').toLowerCase().trim();
        const selectedEvent = (eventSelect?.value || '').toLowerCase();

        filteredAudits = allAudits.filter(audit => {
            const matchesSearch =
                String(audit.id || '').toLowerCase().includes(query) ||
                String(audit.user || audit.username || audit.operator || '').toLowerCase().includes(query) ||
                String(audit.auditable_type || audit.entity || '').toLowerCase().includes(query) ||
                String(audit.auditable_id || audit.reference || '').toLowerCase().includes(query);

            const matchesEvent = !selectedEvent || String(audit.event || '').toLowerCase() === selectedEvent;

            return matchesSearch && matchesEvent;
        });

        applyFiltersAndRender(1);
    };

    searchInput?.addEventListener('input', triggerFilter);
    eventSelect?.addEventListener('change', triggerFilter);
    document.getElementById('btnSearch').addEventListener('click', triggerFilter);
}

function applyFiltersAndRender(page = 1) {
    currentPage = page;
    const tbody = document.getElementById('auditsTableBody');
    if (!tbody) return;

    const total = filteredAudits.length;
    document.getElementById('resultsCount').textContent = total > 0 ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}` : "{{ __('Sem resultados') }}";

    if (total === 0) {
        tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${"{{ __('Nenhum registo de auditoria encontrado com os filtros aplicados.') }}"}</div></td></tr>`;
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    // Lógica interna de Paginação para alinhar visualmente com o equipments
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedAudits = filteredAudits.slice(startIndex, endIndex);

    tbody.innerHTML = paginatedAudits.map(audit => {
        const logId = audit.id ? `#${audit.id}` : '-';
        const user = audit.user || audit.username || audit.operator || 'Sistema / Automático';
        const entity = audit.auditable_type || audit.entity || 'Geral';
        const reference = audit.auditable_id || audit.reference ? `ID: ${audit.auditable_id || audit.reference}` : '-';
        const badge = getEventBadge(audit.event);
        const oldState = formatStateData(audit.old_values || audit.old_state);
        const newState = formatStateData(audit.new_values || audit.new_state);

        const dateFormatted = audit.created_at
            ? new Date(audit.created_at).toLocaleString('pt-PT', { hour12: false })
            : '-';

        return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
            <td class="px-5 py-4 font-mono text-xs text-[var(--text-soft)] font-bold">${logId}</td>
            <td class="px-5 py-4 font-semibold text-[var(--text)]">${user}</td>
            <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${entity}</td>
            <td class="px-5 py-4 font-mono text-xs text-[var(--text-soft)]">${reference}</td>
            <td class="px-5 py-4">${badge}</td>
            <td class="px-5 py-4">${oldState}</td>
            <td class="px-5 py-4">${newState}</td>
            <td class="px-5 py-4 text-right text-xs text-[var(--text-soft)] font-semibold font-mono">${dateFormatted}</td>
        </tr>`;
    }).join('');

    renderPagination(total, page);
}

function renderPagination(totalItems, currPage) {
    const pagEl = document.getElementById('pagination');
    const lastPage = Math.ceil(totalItems / itemsPerPage);

    if (lastPage <= 1) {
        pagEl.innerHTML = '';
        return;
    }

    pagEl.innerHTML = `
        <button onclick="applyFiltersAndRender(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← ${"{{ __('Anterior') }}"}</button>
        <span class="font-bold text-[var(--text-soft)]">${"{{ __('Página') }}"} ${currPage} ${"{{ __('de') }}"} ${lastPage}</span>
        <button onclick="applyFiltersAndRender(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">${"{{ __('Próxima') }}"} →</button>
    `;
}

function renderErrorState() {
    const tbody = document.getElementById('auditsTableBody');
    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--color-danger)] font-medium">
                ⚠️ ${"{{ __('Não foi possível carregar os registos de auditoria de momento.') }}"}
            </td>
        </tr>
    `;
}

document.getElementById('btnClear').addEventListener('click', () => {
    const searchInput = document.getElementById('filter_q');
    const eventSelect = document.getElementById('filter_event');

    if (searchInput) searchInput.value = '';
    if (eventSelect) eventSelect.value = '';

    filteredAudits = [...allAudits];
    applyFiltersAndRender(1);
});

document.getElementById('filter_q').addEventListener('keydown', e => {
    if (e.key === 'Enter') {
        const eventSelect = document.getElementById('filter_event');
        const query = e.target.value.toLowerCase().trim();
        const selectedEvent = (eventSelect?.value || '').toLowerCase();

        filteredAudits = allAudits.filter(audit => {
            const matchesSearch =
                String(audit.id || '').toLowerCase().includes(query) ||
                String(audit.user || audit.username || audit.operator || '').toLowerCase().includes(query) ||
                String(audit.auditable_type || audit.entity || '').toLowerCase().includes(query) ||
                String(audit.auditable_id || audit.reference || '').toLowerCase().includes(query);

            const matchesEvent = !selectedEvent || String(audit.event || '').toLowerCase() === selectedEvent;

            return matchesSearch && matchesEvent;
        });
        applyFiltersAndRender(1);
    }
});
</script>
@endpush
