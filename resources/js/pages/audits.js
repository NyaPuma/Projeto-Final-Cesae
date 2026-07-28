/**
 * Audits Module
 * Handles audit log listing, filtering, and pagination
 */

import { authHeader } from '../utils/api.js';

let allAudits = [];
let filteredAudits = [];
let currentPage = 1;
const itemsPerPage = 10;

async function fetchAudits() {
    const tbody = document.getElementById('auditsTableBody');
    try {
        const response = await window.api.get('/admin/audits', {
            headers: authHeader()
        });

        allAudits = response.data || [];
        filteredAudits = [...allAudits];

        populateEventFilter(allAudits);
        applyFiltersAndRender(1);
    } catch (error) {
        console.error('Erro ao ir buscar a auditoria:', error);
        if (typeof window.showToast === 'function') {
            window.showToast("Não foi possível carregar os registos de auditoria.", 'error');
        }
        renderErrorState();
    }
}

function getEventBadge(event) {
    const value = String(event || "").toLowerCase().trim();

    if (value.includes('create') || value.includes('criar') || value.includes('insert')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">Criar</span>`;
    }
    if (value.includes('update') || value.includes('editar') || value.includes('atualizar')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-800 dark:text-amber-400 border border-amber-500/20 uppercase tracking-tight">Editar</span>`;
    }
    if (value.includes('delete') || value.includes('eliminar') || value.includes('remover')) {
        return `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-red-500/10 text-red-700 dark:text-red-400 border border-red-500/20 uppercase tracking-tight">Eliminar</span>`;
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

    eventSelect.innerHTML = `<option value="">Todos os eventos</option>`;

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
    document.getElementById('resultsCount').textContent = total > 0 ? `${total} resultado(s) encontrado(s)` : 'Sem resultados';

    if (total === 0) {
        tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum registo de auditoria encontrado com os filtros aplicados.</div></td></tr>`;
        document.getElementById('pagination').innerHTML = '';
        return;
    }

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
        <button data-action="pagination-prev" data-page="${currPage - 1}" ${currPage <= 1 ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
        <button data-action="pagination-next" data-page="${currPage + 1}" ${currPage >= lastPage ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">Próxima →</button>
    `;
}

function renderErrorState() {
    const tbody = document.getElementById('auditsTableBody');
    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--color-danger)] font-medium">
                ⚠️ Não foi possível carregar os registos de auditoria de momento.
            </td>
        </tr>
    `;
}

function clearFilters() {
    const searchInput = document.getElementById('filter_q');
    const eventSelect = document.getElementById('filter_event');

    if (searchInput) searchInput.value = '';
    if (eventSelect) eventSelect.value = '';

    filteredAudits = [...allAudits];
    applyFiltersAndRender(1);
}

function setupEventDelegation() {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action="pagination-prev"]');
        if (btn && !btn.disabled) {
            const page = parseInt(btn.dataset.page);
            applyFiltersAndRender(page);
        }

        const nextBtn = e.target.closest('[data-action="pagination-next"]');
        if (nextBtn && !nextBtn.disabled) {
            const page = parseInt(nextBtn.dataset.page);
            applyFiltersAndRender(page);
        }
    });
}

function init() {
    fetchAudits();
    setupFilters();
    setupEventDelegation();

    document.getElementById('btnClear').addEventListener('click', clearFilters);

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
}

export { init };
