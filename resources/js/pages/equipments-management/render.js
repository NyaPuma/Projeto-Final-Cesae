import { renderResultsCount as renderSharedResultsCount, renderResultsFeedback, renderSimplePagination, renderTableEmptyState, renderTableErrorState } from '../../components/listing/feedback.js';
import { getEquipmentTableBody, getPagination, getResultsCount } from './dom.js';

function renderStatusBadge(equipment) {
    const isActive = equipment.active === true || equipment.active === 1 || equipment.active === '1';

    if (isActive) {
        return '<span class="inline-flex items-center gap-1 rounded-lg bg-emerald-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-emerald-700 dark:text-emerald-400">Operacional</span>';
    }

    return '<span class="inline-flex items-center gap-1 rounded-lg bg-red-500/10 px-2.5 py-1 text-[11px] font-bold uppercase tracking-tight text-red-700 dark:text-red-400">Fora de Serviço</span>';
}

function renderEquipmentRow(equipment) {
    const serial = equipment.serial ?? `EQ-${String(equipment.id).padStart(3, '0')}`;
    const location = equipment.room ? `${equipment.room.name} (${equipment.room.location ?? '—'})` : '—';

    return `<tr class="transition-colors duration-150 hover:bg-(--surface-2)/50">
        <td class="px-5 py-4 font-mono font-bold text-(--text-soft)">${serial}</td>
        <td class="px-5 py-4">
            <div class="font-semibold text-(--text)">${equipment.name}</div>
            <div class="mt-0.5 text-[10px] uppercase tracking-wider text-(--text-soft)">${equipment.category?.name ?? 'Genérico'}</div>
        </td>
        <td class="px-5 py-4 font-semibold text-(--text-soft)">${location}</td>
        <td class="px-5 py-4">${renderStatusBadge(equipment)}</td>
        <td class="px-5 py-4 text-right">
            <a href="/ui/tickets/create?equipment_id=${equipment.id}" class="inline-flex min-h-[28px] items-center justify-center rounded-lg border border-(--border) bg-(--surface) px-3 py-1.5 text-[11px] font-semibold text-(--text) shadow-sm transition-all hover:bg-(--surface-2)">Abrir Ticket</a>
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
        tbody: getEquipmentTableBody(),
        colspan: 5,
        message: 'Nenhum equipamento encontrado com os filtros aplicados.',
    });

    const pagination = getPagination();
    if (pagination) pagination.innerHTML = '';
}

export function renderErrorState(message) {
    renderTableErrorState({
        tbody: getEquipmentTableBody(),
        colspan: 5,
        message,
    });
}

export function renderEquipments(equipments) {
    const tbody = getEquipmentTableBody();
    if (!tbody) return;

    tbody.innerHTML = equipments.map(renderEquipmentRow).join('');
}

export function renderPagination(meta, currentPage) {
    renderSimplePagination({
        element: getPagination(),
        meta,
        currentPage,
    });
}
