import { fetchEquipments } from './equipments-management/api.js';
import { bindPagination, clearEquipmentFilters, renderLoadingState } from './equipments-management/dom.js';
import { renderEmptyState, renderEquipments, renderErrorState, renderPagination, renderResultsCount, showFeedback } from './equipments-management/render.js';
import { equipmentsState, setCurrentPage } from './equipments-management/state.js';

async function loadEquipments(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchEquipments(page);
        if (!data) return;

        const equipments = data.equipments?.data ?? data.equipments ?? [];
        const meta = data.equipments ?? {};
        const total = meta.meta?.total ?? meta.total ?? equipments.length;

        renderResultsCount(total);

        if (!equipments.length) {
            renderEmptyState();
            return;
        }

        renderEquipments(equipments);
        renderPagination(meta, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function bindFilters() {
    document.getElementById('btnSearch')?.addEventListener('click', () => loadEquipments(1));

    document.getElementById('btnClear')?.addEventListener('click', () => {
        clearEquipmentFilters();
        loadEquipments(1);
    });

    document.getElementById('filter_q')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadEquipments(1);
    });

    document.getElementById('filter_status')?.addEventListener('change', () => loadEquipments(1));
}

function init() {
    bindFilters();
    bindPagination(loadEquipments);
    loadEquipments(equipmentsState.currentPage);
}

export { init };
