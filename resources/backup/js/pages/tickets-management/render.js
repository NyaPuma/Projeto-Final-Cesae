import { getPagination, getResultsCount, getTicketsBody } from './dom.js';

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

export function showFeedback(message, error = false) {
    const element = getResultsCount();
    if (!element) return;

    element.textContent = message;
    element.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

export function renderResultsCount(total) {
    showFeedback(total > 0 ? `${total} resultado(s) encontrado(s)` : 'Sem resultados');
}

function renderStatusBadge(statusName) {
    const statusKey = (statusName || '').toLowerCase();

    if (statusKey === 'aberta' || statusKey === 'aberto') {
        return `<span class="inline-flex items-center gap-1 rounded-lg bg-blue-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-blue-700 dark:text-blue-400">${statusTranslations.aberta}</span>`;
    }

    if (statusKey === 'em curso') {
        return `<span class="inline-flex items-center gap-1 rounded-lg bg-amber-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-amber-800 dark:text-amber-400">${statusTranslations['em curso']}</span>`;
    }

    return `<span class="inline-flex items-center gap-1 rounded-lg bg-[var(--text-soft)]/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-[var(--text-soft)]">${statusTranslations.fechada}</span>`;
}

function renderTicketRow(ticket) {
    const priorityKey = (ticket.priority || '').toLowerCase();
    const priorityClass = priorityColors[priorityKey] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
    const priorityLabel = priorityTranslations[priorityKey] ?? ticket.priority;
    const statusName = ticket.status?.name ?? ticket.status ?? 'N/A';

    return `<tr class="transition-colors duration-150 hover:bg-[var(--surface-2)]/50">
        <td class="px-5 py-4 font-mono font-bold text-[var(--text-soft)]">#${ticket.id}</td>
        <td class="max-w-xs truncate px-5 py-4 font-semibold text-[var(--text)]" title="${ticket.title}">${ticket.title}</td>
        <td class="px-5 py-4">
            <span class="inline-block rounded-lg px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight ${priorityClass}">${priorityLabel}</span>
        </td>
        <td class="px-5 py-4">${renderStatusBadge(statusName)}</td>
        <td class="px-5 py-4 font-semibold text-[var(--text-soft)]">${ticket.equipment ? ticket.equipment.name : '—'}</td>
        <td class="px-5 py-4 font-semibold text-[var(--text-soft)]">${ticket.room ? ticket.room.name : '—'}</td>
        <td class="px-5 py-4 text-xs font-semibold text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="font-normal italic text-[var(--text-soft)]">—</span>'}</td>
        <td class="px-5 py-4 text-right">
            <a href="/ui/tickets/${ticket.id}" class="inline-flex min-h-[28px] min-w-[48px] items-center justify-center rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-[11px] font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">Ver</a>
        </td>
    </tr>`;
}

export function renderEmptyState() {
    const tbody = getTicketsBody();
    const pagination = getPagination();

    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum ticket encontrado com os filtros aplicados.</div></td></tr>';
    }

    if (pagination) pagination.innerHTML = '';
}

export function renderErrorState(message) {
    const tbody = getTicketsBody();
    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs font-medium text-[var(--color-danger)]">⚠️ ${message}</td></tr>`;
}

export function renderTickets(tickets) {
    const tbody = getTicketsBody();
    if (!tbody) return;

    tbody.innerHTML = tickets.map(renderTicketRow).join('');
}

export function renderPagination(meta, currentPage) {
    const pagination = getPagination();
    if (!pagination) return;

    const lastPage = meta.last_page ?? 1;
    const page = meta.current_page ?? currentPage;

    if (lastPage <= 1) {
        pagination.innerHTML = '';
        return;
    }

    pagination.innerHTML = `
        <button data-page="${page - 1}" ${page <= 1 ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${page} de ${lastPage}</span>
        <button data-page="${page + 1}" ${page >= lastPage ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">Próxima →</button>
    `;
}
