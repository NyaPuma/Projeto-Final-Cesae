import { renderResultsCount as renderSharedResultsCount, renderResultsFeedback, renderSimplePagination, renderTableEmptyState, renderTableErrorState } from '../../components/listing/feedback.js';
import { getPagination, getResultsCount, getRoomsTableBody } from './dom.js';

function renderRoomRow(room) {
    const equipmentCount = room.equipments_count ?? room.equipments?.length ?? 0;

    return `<tr class="transition-colors duration-150 hover:bg-[var(--surface-2)]/50">
        <td class="px-5 py-4">
            <div class="font-semibold text-[var(--text)]">${room.name}</div>
            <div class="mt-0.5 font-mono text-[10px] text-[var(--text-soft)]">${room.code || '—'}</div>
        </td>
        <td class="px-5 py-4 font-semibold text-[var(--text-soft)]">${room.location || '—'}</td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center gap-1 rounded-lg bg-blue-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-blue-700 dark:text-blue-400">${equipmentCount} equipamento(s)</span>
        </td>
        <td class="px-5 py-4 text-right">
            <a href="/ui/rooms/${room.id}" class="inline-flex min-h-[28px] items-center justify-center rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-[11px] font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">Ver detalhes</a>
        </td>
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
        tbody: getRoomsTableBody(),
        colspan: 4,
        message: 'Nenhuma sala encontrada com os filtros aplicados.',
    });

    const pagination = getPagination();
    if (pagination) pagination.innerHTML = '';
}

export function renderErrorState(message) {
    renderTableErrorState({
        tbody: getRoomsTableBody(),
        colspan: 4,
        message,
    });
}

export function renderRooms(rooms) {
    const tbody = getRoomsTableBody();
    if (!tbody) return;

    tbody.innerHTML = rooms.map(renderRoomRow).join('');
}

export function renderPagination(meta, currentPage) {
    renderSimplePagination({
        element: getPagination(),
        meta,
        currentPage,
    });
}
