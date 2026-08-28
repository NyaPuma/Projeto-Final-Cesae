import { renderResultsCount as renderSharedResultsCount, renderResultsFeedback, renderSimplePagination, renderTableEmptyState, renderTableErrorState } from '../../components/listing/feedback.js';
import { getEquipmentTableBody, getPagination, getResultsCount } from './dom.js';

const translations = () => window.SGM_EQUIPMENT_I18N || {};

function renderStatusBadge(equipment) {
    const isActive = equipment.active === true || equipment.active === 1 || equipment.active === '1';

    if (isActive) {
        return `<span class="inline-flex items-center gap-1 rounded-lg bg-success/10 px-2.5 py-1 text-xs font-bold uppercase tracking-tight text-success">${translations().operational || ''}</span>`;
    }

    return `<span class="inline-flex items-center gap-1 rounded-lg bg-danger/10 px-2.5 py-1 text-xs font-bold uppercase tracking-tight text-danger">${translations().inactive || ''}</span>`;
}

function renderEquipmentRow(equipment) {
    const serial = equipment.serial ?? `EQ-${String(equipment.id).padStart(3, '0')}`;
    const location = equipment.room ? `${equipment.room.name} (${equipment.room.location ?? '—'})` : '—';

    return `<tr class="transition-colors duration-150 hover:bg-(--surface-2)/50">
        <td class="px-5 py-4 font-mono font-bold text-(--text-soft)" data-label="${translations().code || ''}">${serial}</td>
        <td class="px-5 py-4" data-label="${translations().equipment || ''}">
            <div class="ui-listing-value">
                <div class="font-semibold text-(--text)">${equipment.name}</div>
                <div class="mt-0.5 text-xs uppercase tracking-wider text-(--text-soft)">${equipment.category?.name ?? translations().generic ?? ''}</div>
            </div>
        </td>
        <td class="px-5 py-4 font-semibold text-(--text-soft)" data-label="${translations().location || ''}">${location}</td>
        <td class="px-5 py-4" data-label="${translations().status || ''}">${renderStatusBadge(equipment)}</td>
        <td class="ui-listing-actions px-5 py-4 text-right">
            <div class="inline-flex items-center justify-end gap-1.5">
                <a href="/ui/tickets/create?equipment_id=${equipment.id}" class="inline-flex min-h-[28px] items-center justify-center rounded-lg border border-(--border) bg-(--surface) px-3 py-1.5 text-xs font-semibold text-(--text) shadow-sm transition-all hover:bg-(--surface-2)">${translations().openTicket || ''}</a>
                <a href="/ui/equipments/${equipment.id}" class="inline-flex min-h-[28px] items-center justify-center rounded-lg border border-(--border) bg-(--surface) px-3 py-1.5 text-xs font-semibold text-(--text) shadow-sm transition-all hover:bg-(--surface-2)">${translations().details || ''}</a>
            </div>
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
        message: translations().empty || '',
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
