import { renderResultsCount as renderSharedResultsCount, renderResultsFeedback, renderSimplePagination, renderTableEmptyState, renderTableErrorState } from '../../components/listing/feedback.js';
import { getAuditsTableBody, getEventSelect, getPagination, getResultsCount } from './dom.js';

function getEventBadge(event) {
    const value = String(event || '').toLowerCase().trim();

    if (value.includes('create') || value.includes('criar') || value.includes('insert')) {
        return '<span class="inline-flex items-center gap-1 rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-emerald-700 dark:text-emerald-400">Criar</span>';
    }

    if (value.includes('update') || value.includes('editar') || value.includes('atualizar')) {
        return '<span class="inline-flex items-center gap-1 rounded-lg border border-amber-500/20 bg-amber-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-amber-800 dark:text-amber-400">Editar</span>';
    }

    if (value.includes('delete') || value.includes('eliminar') || value.includes('remover')) {
        return '<span class="inline-flex items-center gap-1 rounded-lg border border-red-500/20 bg-red-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-red-700 dark:text-red-400">Eliminar</span>';
    }

    return `<span class="inline-flex items-center gap-1 rounded-lg border border-(--border) bg-(--surface-2) px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-(--text-soft)">${event}</span>`;
}

function formatStateData(state) {
    if (!state) return '<span class="font-mono text-(--text-soft)">-</span>';

    if (typeof state === 'object') {
        return `<pre class="max-h-40 max-w-xs overflow-auto rounded-xl border border-(--border) bg-(--surface-2) p-2 text-[10px] leading-relaxed text-(--text-soft)">${JSON.stringify(state, null, 2)}</pre>`;
    }

    try {
        const parsed = JSON.parse(state);
        return `<pre class="max-h-40 max-w-xs overflow-auto rounded-xl border border-(--border) bg-(--surface-2) p-2 text-[10px] leading-relaxed text-(--text-soft)">${JSON.stringify(parsed, null, 2)}</pre>`;
    } catch {
        return `<span class="line-clamp-2 break-all font-mono text-xs text-(--text-soft)" title="${state}">${state}</span>`;
    }
}

export function populateEventFilter(audits) {
    const select = getEventSelect();
    if (!select) return;

    const currentValue = select.value;
    const uniqueEvents = [...new Set(audits.map((item) => String(item.event || '').trim()))].filter(Boolean);

    select.innerHTML = '<option value="">Todos os eventos</option>';

    uniqueEvents.forEach((eventName) => {
        const option = document.createElement('option');
        option.value = eventName.toLowerCase();
        option.textContent = eventName.charAt(0).toUpperCase() + eventName.slice(1);
        select.appendChild(option);
    });

    select.value = currentValue;
}

export function showFeedback(message, error = false) {
    renderResultsFeedback(getResultsCount(), message, error);
}

export function renderResultsCount(total) {
    renderSharedResultsCount(getResultsCount(), total);
}

export function renderEmptyState() {
    renderTableEmptyState({
        tbody: getAuditsTableBody(),
        colspan: 8,
        message: 'Nenhum registo de auditoria encontrado com os filtros aplicados.',
    });
}

export function renderErrorState(message) {
    renderTableErrorState({
        tbody: getAuditsTableBody(),
        colspan: 8,
        message,
    });
}

export function renderAudits(audits) {
    const tbody = getAuditsTableBody();
    if (!tbody) return;

    tbody.innerHTML = audits.map((audit) => {
        const logId = audit.id ? `#${audit.id}` : '-';
        const user = audit.user?.name || audit.user || audit.username || audit.operator || 'Sistema / Automático';
        const entity = audit.auditable_type || audit.entity || 'Geral';
        const referenceValue = audit.auditable_id || audit.reference;
        const reference = referenceValue ? `ID: ${referenceValue}` : '-';
        const dateFormatted = audit.created_at
            ? new Date(audit.created_at).toLocaleString('pt-PT', { hour12: false })
            : '-';

        return `<tr class="transition-colors duration-150 hover:bg-(--surface-2)/50">
            <td class="px-5 py-4 font-mono text-xs font-bold text-(--text-soft)">${logId}</td>
            <td class="px-5 py-4 font-semibold text-(--text)">${user}</td>
            <td class="px-5 py-4 font-semibold text-(--text-soft)">${entity}</td>
            <td class="px-5 py-4 font-mono text-xs text-(--text-soft)">${reference}</td>
            <td class="px-5 py-4">${getEventBadge(audit.event)}</td>
            <td class="px-5 py-4">${formatStateData(audit.old_values || audit.old_state)}</td>
            <td class="px-5 py-4">${formatStateData(audit.new_values || audit.new_state)}</td>
            <td class="px-5 py-4 text-right font-mono text-xs font-semibold text-(--text-soft)">${dateFormatted}</td>
        </tr>`;
    }).join('');
}

export function renderPagination(meta, currentPage) {
    renderSimplePagination({
        element: getPagination(),
        meta,
        currentPage,
    });
}
