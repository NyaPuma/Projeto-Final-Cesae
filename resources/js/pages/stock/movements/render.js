import { renderResultsCount as renderSharedResultsCount, renderResultsFeedback, renderSimplePagination, renderTableEmptyState, renderTableErrorState } from '../../../components/listing/feedback.js';
import { getMovementTableBody, getPagination, getResultsCount } from './dom.js';
import { formatDateTime } from '../../../utils/locale.js';

function escapeHtml(value) {
    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#39;');
}

function renderMovementRow(movement) {
    const typeLabels = window.SGM_ENUM_I18N?.movement || {};
    const typeColors = {
        in: 'text-emerald-700 dark:text-emerald-400',
        out: 'text-rose-700 dark:text-rose-400',
        adjust: 'text-amber-700 dark:text-amber-400',
        return: 'text-blue-700 dark:text-blue-400',
    };
    const delta = Number(movement.delta) || Number(movement.quantity) || 0;
    const sign = delta > 0 ? '+' : '';
    const deltaColor = delta > 0 ? 'text-emerald-700 dark:text-emerald-400' : 'text-rose-700 dark:text-rose-400';

    const date = movement.created_at
        ? formatDateTime(movement.created_at)
        : '—';

    return `<tr class="transition-colors duration-150 hover:bg-(--surface-2)/50">
        <td class="px-5 py-4 font-semibold text-(--text-soft)" data-label="Data">${escapeHtml(date)}</td>
        <td class="px-5 py-4" data-label="Peça">
            <div class="ui-listing-value">
                <div class="font-semibold text-(--text)">${escapeHtml(movement.part?.name ?? `Peça #${movement.part_id}`)}</div>
                <div class="mt-0.5 font-mono text-[10px] uppercase tracking-wider text-(--text-soft)">${escapeHtml(movement.part?.sku ?? '')}</div>
            </div>
        </td>
        <td class="px-5 py-4" data-label="Tipo">
            <span class="inline-flex items-center gap-1 rounded-lg bg-(--surface-2) px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight ${typeColors[movement.movement_type] ?? ''}">
                ${escapeHtml(typeLabels[movement.movement_type] ?? movement.movement_type)}
            </span>
        </td>
        <td class="px-5 py-4 font-black ${deltaColor}" data-label="Variação">
            ${sign}${delta}
            ${movement.stock_after != null ? `<span class="ml-1 text-[10px] font-semibold text-(--text-soft)">→ ${movement.stock_after}</span>` : ''}
        </td>
        <td class="px-5 py-4 font-semibold text-(--text-soft)" data-label="Motivo">${escapeHtml(movement.reason ?? '—')}</td>
    </tr>`;
}

export function showFeedback(message, error = false) {
    renderResultsFeedback(getResultsCount(), message, error);
}

export function renderResultsCount(total) {
    renderSharedResultsCount(getResultsCount(), total);
}

export function renderEmptyState() {
    renderTableEmptyState({
        tbody: getMovementTableBody(),
        colspan: 5,
        message: 'Nenhum movimento encontrado com os filtros aplicados.',
    });

    const pagination = getPagination();
    if (pagination) pagination.innerHTML = '';
}

export function renderErrorState(message) {
    renderTableErrorState({
        tbody: getMovementTableBody(),
        colspan: 5,
        message,
    });
}

export function renderMovements(movements) {
    const tbody = getMovementTableBody();
    if (!tbody) return;

    tbody.innerHTML = movements.map(renderMovementRow).join('');
}

export function renderPagination(pagination, currentPage) {
    renderSimplePagination({
        element: getPagination(),
        meta: pagination ?? {},
        currentPage,
    });
}
