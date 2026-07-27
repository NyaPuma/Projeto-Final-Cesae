@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Auditoria do Sistema'),
    'subtitle' => __('Rastreabilidade, histórico de ações e registo de alterações efetuadas pelos utilizadores.'),
    'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel') . '</a></div>'
])

    {{-- Painel de Filtros --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2 lg:col-span-3">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Pesquisa Geral') }}</label>
                <input id="filter_q" placeholder="{{ __('Pesquise por utilizador, elemento ou ID de registo...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="filter_event" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Ação / Evento') }}</label>
                <select id="filter_event" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                    <option value="">{{ __('Todas as Ações') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-orange-600 transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Registos --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Log ID') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Utilizador / Operador') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Elemento Afetado') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Tipo de Ação') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Campos Modificados') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Data e Hora') }}</th>
                        <th class="px-5 py-4 text-right font-bold">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="auditsTableContentBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                A carregar histórico de auditoria...
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginação --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent

{{-- Modal de Comparação e Inspeção do Log --}}
<div id="auditDetailModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-3xl rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto">
        
        <div class="flex items-center justify-between pb-4 border-b border-[var(--border)] mb-4">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]" id="modalLogIdHeader"></span>
                <h3 class="text-base font-bold text-[var(--text)]" id="modalAuditTitle">Detalhes do Registo</h3>
            </div>
            <button onclick="closeModal('auditDetailModal')" class="text-[var(--text-soft)] hover:text-[var(--text)] font-bold text-lg cursor-pointer">&times;</button>
        </div>

        {{-- Cabeçalho Informativo --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-[var(--surface-2)] p-3.5 rounded-xl border border-[var(--border)] text-xs mb-5">
            <div><span class="text-[10px] uppercase font-bold text-[var(--text-soft)] block">Operador</span><strong id="modalUser" class="text-[var(--text)]"></strong></div>
            <div><span class="text-[10px] uppercase font-bold text-[var(--text-soft)] block">Data / Hora</span><strong id="modalDate" class="text-[var(--text)]"></strong></div>
            <div><span class="text-[10px] uppercase font-bold text-[var(--text-soft)] block">Elemento</span><strong id="modalEntity" class="text-[var(--text)]"></strong></div>
            <div><span class="text-[10px] uppercase font-bold text-[var(--text-soft)] block">Ação</span><div id="modalBadge" class="mt-0.5"></div></div>
        </div>

        {{-- Tabela de Comparação Visual (Antes vs Depois) --}}
        <div class="overflow-hidden rounded-xl border border-[var(--border)] bg-[var(--surface)]">
            <table class="w-full text-left text-xs divide-y divide-[var(--border)]">
                <thead class="bg-[var(--surface-2)] text-[10px] uppercase font-bold text-[var(--text-soft)]">
                    <tr>
                        <th class="px-4 py-2.5">Campo / Propriedade</th>
                        <th class="px-4 py-2.5 text-rose-400">Valor Anterior (Antes)</th>
                        <th class="px-4 py-2.5 text-emerald-400">Novo Valor (Depois)</th>
                    </tr>
                </thead>
                <tbody id="modalDiffTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    {{-- Preenchido dinamicamente via JS --}}
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-[var(--border)] flex justify-end">
            <button type="button" onclick="closeModal('auditDetailModal')" class="px-5 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">
                Fechar
            </button>
        </div>
    </div>
</div>

<script>
let allAudits = [];
let filteredAudits = [];
let currentPage = 1;
const itemsPerPage = 10;

// Mapeamento amigável de campos de base de dados para Português
const fieldTranslations = {
    'title': 'Título',
    'description': 'Descrição',
    'status': 'Estado Operacional',
    'priority': 'Prioridade',
    'name': 'Nome',
    'serial': 'Número de Série',
    'is_preventive': 'Manutenção Preventiva',
    'room_id': 'ID da Sala',
    'user_id': 'ID do Utilizador',
    'technician_id': 'Técnico Atribuído',
    'active': 'Ativo/Operacional',
    'building': 'Edifício / Bloco',
    'location': 'Localização'
};

function getAuthHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
        headers['X-Auth-Token'] = token;
    }
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

function formatEntityName(rawEntity, id) {
    if (!rawEntity) return 'Sistema';
    const str = String(rawEntity);
    let label = 'Elemento';

    if (str.includes('Ticket')) label = 'Avaria / Ticket';
    else if (str.includes('Equipment')) label = 'Equipamento';
    else if (str.includes('Room')) label = 'Sala';
    else if (str.includes('User')) label = 'Utilizador';
    else if (str.includes('Profile')) label = 'Perfil';
    else label = str.split('\\').pop() || str;

    return id ? `${label} #${id}` : label;
}

function getEventBadge(event) {
    const value = String(event || "").toLowerCase().trim();

    if (value.includes('create') || value.includes('criar') || value.includes('insert')) {
        return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 uppercase tracking-wider">Criação</span>`;
    }
    if (value.includes('update') || value.includes('editar') || value.includes('atualizar')) {
        return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-wider">Edição</span>`;
    }
    if (value.includes('delete') || value.includes('eliminar') || value.includes('remover')) {
        return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-500/10 text-rose-500 border border-rose-500/20 uppercase tracking-wider">Remoção</span>`;
    }

    return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-800 text-slate-300 border border-slate-700/80 uppercase tracking-wider">${event.toUpperCase()}</span>`;
}

function parseStateObject(state) {
    if (!state) return null;
    if (typeof state === 'object') return state;
    try {
        return JSON.parse(state);
    } catch (e) {
        return null;
    }
}

function renderSummaryChanges(audit) {
    const oldObj = parseStateObject(audit.old_values || audit.old_state);
    const newObj = parseStateObject(audit.new_values || audit.new_state);

    if (!oldObj && !newObj) return '<span class="text-[var(--text-soft)] font-mono">-</span>';

    const keys = new Set([
        ...Object.keys(oldObj || {}),
        ...Object.keys(newObj || {})
    ]);

    const fieldsChanged = Array.from(keys)
        .filter(k => !['updated_at', 'created_at', 'id'].includes(k))
        .map(k => fieldTranslations[k] || k);

    if (fieldsChanged.length === 0) return '<span class="text-[var(--text-soft)] italic">Sem alterações registadas</span>';

    return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-800/80 text-slate-300 border border-slate-700/80">
        📝 ${fieldsChanged.slice(0, 2).join(', ')}${fieldsChanged.length > 2 ? ' +' + (fieldsChanged.length - 2) : ''}
    </span>`;
}

async function fetchAudits() {
    const tbody = document.getElementById('auditsTableContentBody');
    const endpoints = ['/api/audits', '/audits', '/admin/audits'];
    let resData = null;

    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, { headers: getAuthHeader() });
            if (res.ok) {
                resData = await res.json();
                break;
            }
        } catch (e) {}
    }

    if (!resData) {
        if (tbody) tbody.innerHTML = '<tr><td colspan="7" class="px-5 py-12 text-center text-xs text-red-400">Não foi possível carregar os registos de auditoria.</td></tr>';
        return;
    }

    allAudits = resData.audits?.data || resData.audits || resData.data || (Array.isArray(resData) ? resData : []);
    filteredAudits = [...allAudits];

    populateEventFilter(allAudits);
    applyFiltersAndRender(1);
}

function populateEventFilter(audits) {
    const eventSelect = document.getElementById('filter_event');
    if (!eventSelect) return;

    const uniqueEvents = [...new Set(audits.map(item => String(item.event || '').trim()))].filter(Boolean);

    eventSelect.innerHTML = '<option value="">Todas as Ações</option>';
    uniqueEvents.forEach(ev => {
        const option = document.createElement('option');
        option.value = ev.toLowerCase();
        option.textContent = ev.charAt(0).toUpperCase() + ev.slice(1);
        eventSelect.appendChild(option);
    });
}

function applyFiltersAndRender(page = 1) {
    currentPage = page;
    const tbody = document.getElementById('auditsTableContentBody');
    if (!tbody) return;

    const total = filteredAudits.length;
    document.getElementById('resultsCount').textContent = total > 0 ? `${total} registo(s) encontrado(s)` : "0 registos";

    if (total === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum registo de auditoria encontrado.</div></td></tr>';
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    const startIndex = (page - 1) * itemsPerPage;
    const paginatedAudits = filteredAudits.slice(startIndex, startIndex + itemsPerPage);

    tbody.innerHTML = paginatedAudits.map((audit, index) => {
        const globalIndex = startIndex + index;
        const logId = audit.id ? `#${audit.id}` : '-';
        const user = audit.user?.name || audit.user || audit.username || audit.operator || 'Sistema Automático';
        const entityFormatted = formatEntityName(audit.auditable_type || audit.entity, audit.auditable_id || audit.reference);
        const badge = getEventBadge(audit.event);
        const summary = renderSummaryChanges(audit);

        const dateFormatted = audit.created_at
            ? new Date(audit.created_at).toLocaleString('pt-PT', { hour12: false })
            : '-';

        return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
            <td class="px-5 py-4 font-mono text-xs text-[var(--text-soft)] font-bold">${logId}</td>
            <td class="px-5 py-4 font-semibold text-[var(--text)]">${user}</td>
            <td class="px-5 py-4 font-bold text-[var(--text)]">${entityFormatted}</td>
            <td class="px-5 py-4">${badge}</td>
            <td class="px-5 py-4">${summary}</td>
            <td class="px-5 py-4 text-xs text-[var(--text-soft)] font-semibold font-mono">${dateFormatted}</td>
            <td class="px-5 py-4 text-right">
                <button onclick="openAuditModal(${globalIndex})" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-slate-200 bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700/80 rounded-xl transition-all cursor-pointer">
                    Ver Detalhes
                </button>
            </td>
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
            class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
        <button onclick="applyFiltersAndRender(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
            class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">Próxima →</button>
    `;
}

function formatDisplayValue(val) {
    if (val === null || val === undefined || val === '') return '<em class="text-[var(--text-soft)]">Vazio / Nulo</em>';
    if (val === true || val === 1 || val === '1') return '<span class="text-emerald-400 font-bold">Sim / Ativo</span>';
    if (val === false || val === 0 || val === '0') return '<span class="text-rose-400 font-bold">Não / Inativo</span>';
    return String(val);
}

function openAuditModal(index) {
    const audit = filteredAudits[index];
    if (!audit) return;

    document.getElementById('modalLogIdHeader').textContent = `REGISTO #${audit.id || ''}`;
    document.getElementById('modalAuditTitle').textContent = `Auditoria: ${formatEntityName(audit.auditable_type || audit.entity, audit.auditable_id || audit.reference)}`;
    document.getElementById('modalUser').textContent = audit.user?.name || audit.user || audit.username || 'Sistema Automático';
    document.getElementById('modalDate').textContent = audit.created_at ? new Date(audit.created_at).toLocaleString('pt-PT') : '-';
    document.getElementById('modalEntity').textContent = formatEntityName(audit.auditable_type || audit.entity, audit.auditable_id || audit.reference);
    document.getElementById('modalBadge').innerHTML = getEventBadge(audit.event);

    const oldObj = parseStateObject(audit.old_values || audit.old_state) || {};
    const newObj = parseStateObject(audit.new_values || audit.new_state) || {};

    const allKeys = new Set([
        ...Object.keys(oldObj),
        ...Object.keys(newObj)
    ]);

    const keysToDisplay = Array.from(allKeys).filter(k => !['updated_at', 'created_at', 'id'].includes(k));
    const tableBody = document.getElementById('modalDiffTableBody');

    if (keysToDisplay.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="3" class="px-4 py-8 text-center text-[var(--text-soft)]">Sem alterações diretas de propriedades para exibir.</td></tr>';
    } else {
        tableBody.innerHTML = keysToDisplay.map(key => {
            const fieldLabel = fieldTranslations[key] || key;
            const oldVal = formatDisplayValue(oldObj[key]);
            const newVal = formatDisplayValue(newObj[key]);

            return `<tr class="hover:bg-[var(--surface-2)]/50">
                <td class="px-4 py-3 font-semibold text-[var(--text)]">${fieldLabel}</td>
                <td class="px-4 py-3 font-mono text-rose-300/90">${oldVal}</td>
                <td class="px-4 py-3 font-mono text-emerald-300/90">${newVal}</td>
            </tr>`;
        }).join('');
    }

    const modal = document.getElementById('auditDetailModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    document.body.classList.add('overflow-hidden');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.body.classList.remove('overflow-hidden');
}

document.addEventListener('DOMContentLoaded', () => {
    fetchAudits();

    const searchInput = document.getElementById('filter_q');
    const eventSelect = document.getElementById('filter_event');

    const triggerFilter = () => {
        const query = (searchInput?.value || '').toLowerCase().trim();
        const selectedEvent = (eventSelect?.value || '').toLowerCase();

        filteredAudits = allAudits.filter(audit => {
            const matchesSearch =
                String(audit.id || '').toLowerCase().includes(query) ||
                String(audit.user || audit.username || '').toLowerCase().includes(query) ||
                String(audit.auditable_type || audit.entity || '').toLowerCase().includes(query) ||
                String(audit.auditable_id || audit.reference || '').toLowerCase().includes(query);

            const matchesEvent = !selectedEvent || String(audit.event || '').toLowerCase() === selectedEvent;

            return matchesSearch && matchesEvent;
        });

        applyFiltersAndRender(1);
    };

    searchInput?.addEventListener('input', triggerFilter);
    eventSelect?.addEventListener('change', triggerFilter);
    document.getElementById('btnSearch')?.addEventListener('click', triggerFilter);

    document.getElementById('btnClear')?.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        if (eventSelect) eventSelect.value = '';
        filteredAudits = [...allAudits];
        applyFiltersAndRender(1);
    });
});
</script>
@endsection