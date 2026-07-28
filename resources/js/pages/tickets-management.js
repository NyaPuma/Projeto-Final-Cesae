/**
 * Tickets Management Module
 * Handles tickets listing, filtering, and search
 */

import { authHeader } from '../utils/api.js';

const priorityColors = {
    baixa: 'border border-emerald-500/20 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
    média: 'border border-amber-500/20 bg-amber-500/10 text-amber-800 dark:text-amber-400',
    alta: 'border border-orange-500/20 bg-orange-500/10 text-orange-800 dark:text-orange-400',
    crítica: 'border border-purple-500/25 bg-purple-500/10 text-purple-800 dark:text-purple-400',
};

const priorityTranslations = {
    baixa: 'Baixa',
    média: 'Média',
    alta: 'Alta',
    crítica: 'Crítica',
};

const statusTranslations = {
    aberta: 'Aberta',
    aberto: 'Aberta',
    'em curso': 'Em Curso',
    fechada: 'Fechada',
    fechado: 'Fechada',
};

let currentPage = 1;

async function loadTickets(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q = document.getElementById('filter_q').value.trim();
    const status = document.getElementById('filter_status').value;
    const priority = document.getElementById('filter_priority').value;
    const dateFrom = document.getElementById('filter_date_from').value;
    const dateTo = document.getElementById('filter_date_to').value;

    if (q) params.append('q', q);
    if (status) params.append('status', status);
    if (priority) params.append('priority', priority);
    if (dateFrom) params.append('date_from', dateFrom);
    if (dateTo) params.append('date_to', dateTo);
    params.append('page', page);

    const endpoint = '/tickets/search';
    const url = `${endpoint}?${params.toString()}`;

    const tbody = document.getElementById('ticketsBody');
    tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>`;

    try {
        const res = await fetch(url, { headers: authHeader() });

        if (res.status === 401) {
            showFeedback('Autenticação necessária. Faça login.', true);
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            const errData = await res.json().catch(() => ({}));
            showFeedback(errData.message || 'Não foi possível carregar os tickets de momento.', true);
            return;
        }
        const data = await res.json().catch(() => ({}));

        const tickets = data.tickets?.data ?? data.tickets ?? [];
        const meta = data.tickets?.meta ?? data.tickets ?? {};
        const total = meta.total ?? tickets.length;

        document.getElementById('resultsCount').textContent = total > 0
            ? `${total} resultado(s) encontrado(s)`
            : 'Sem resultados';

        if (!tickets.length) {
            tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum ticket encontrado com os filtros aplicados.</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = tickets.map(t => {
            const priorityKey = (t.priority || '').toLowerCase();
            const priColor = priorityColors[priorityKey] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
            const priorityLabel = priorityTranslations[priorityKey] ?? t.priority;
            const statusName = t.status?.name ?? t.status ?? 'N/A';
            const statusKey = statusName.toLowerCase();

            let statusBadge = `<span class="inline-flex items-center gap-1.5 font-bold text-[var(--text)] text-[11px] uppercase tracking-tight">${statusTranslations[statusKey] || 'Fechada'}</span>`;
            if (statusKey === 'aberta' || statusKey === 'aberto') {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-700 dark:text-blue-400 uppercase tracking-tight">${statusTranslations.aberta}</span>`;
            } else if (statusKey === 'em curso') {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-800 dark:text-amber-400 uppercase tracking-tight">${statusTranslations['em curso']}</span>`;
            } else {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight">${statusTranslations.fechada}</span>`;
            }

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">#${t.id}</td>
                <td class="px-5 py-4 font-semibold text-[var(--text)] max-w-xs truncate" title="${t.title}">${t.title}</td>
                <td class="px-5 py-4">
                    <span class="inline-block px-2.5 py-1 rounded-lg text-[11px] font-bold uppercase tracking-tight ${priColor}">${priorityLabel}</span>
                </td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${t.equipment ? t.equipment.name : '—'}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${t.room ? t.room.name : '—'}</td>
                <td class="px-5 py-4 text-xs font-semibold text-[var(--text)]">${t.technician ? t.technician.name : '<span class="text-[var(--text-soft)] font-normal italic">—</span>'}</td>
                <td class="px-5 py-4 text-right">
                    <a href="/ui/tickets/${t.id}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px] min-w-[48px]">Ver</a>
                </td>
            </tr>`;
        }).join('');

        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl = document.getElementById('pagination');
        if (lastPage <= 1) {
            pagEl.innerHTML = '';
            return;
        }
        pagEl.innerHTML = `
            <button data-page="${currPage - 1}" ${currPage <= 1 ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← Anterior</button>
            <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
            <button data-page="${currPage + 1}" ${currPage >= lastPage ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">Próxima →</button>
        `;
    } catch (err) {
        showFeedback('Erro ao carregar tickets. ' + err.message, true);
    }
}

function showFeedback(message, error = false) {
    const el = document.getElementById('resultsCount');
    if (!el) return;
    el.textContent = message;
    el.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

function init() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');
    const filterQ = document.getElementById('filter_q');
    const filterStatus = document.getElementById('filter_status');
    const filterPriority = document.getElementById('filter_priority');
    const filterDateFrom = document.getElementById('filter_date_from');
    const filterDateTo = document.getElementById('filter_date_to');
    const pagination = document.getElementById('pagination');

    if (btnSearch) btnSearch.addEventListener('click', () => loadTickets(1));
    if (btnClear) btnClear.addEventListener('click', () => {
        ['filter_q', 'filter_status', 'filter_priority', 'filter_date_from', 'filter_date_to'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
        loadTickets(1);
    });
    if (filterQ) filterQ.addEventListener('keydown', e => {
        if (e.key === 'Enter') loadTickets(1);
    });
    if (filterStatus) filterStatus.addEventListener('change', () => loadTickets(1));
    if (filterPriority) filterPriority.addEventListener('change', () => loadTickets(1));
    if (filterDateFrom) filterDateFrom.addEventListener('change', () => loadTickets(1));
    if (filterDateTo) filterDateTo.addEventListener('change', () => loadTickets(1));

    if (pagination) {
        pagination.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-page]');
            if (btn && !btn.disabled) {
                const page = parseInt(btn.dataset.page);
                loadTickets(page);
            }
        });
    }

    loadTickets(1);
}

export { init };
