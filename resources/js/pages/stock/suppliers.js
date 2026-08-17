import { fetchSuppliers } from './suppliers/api.js';
import { bindPagination, clearSupplierFilters, renderLoadingState } from './suppliers/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderResultsCount, renderSuppliers, showFeedback } from './suppliers/render.js';
import { setCurrentPage, suppliersState } from './suppliers/state.js';

async function loadSuppliers(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchSuppliers(page);
        if (!data) return;

        const suppliers = data.suppliers?.data ?? data.suppliers ?? [];
        const pagination = data.pagination ?? {};
        const total = pagination.total ?? suppliers.length;

        renderResultsCount(total);

        if (!suppliers.length) {
            renderEmptyState();
            return;
        }

        renderSuppliers(suppliers);
        renderPagination(pagination, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function bindFilters() {
    document.getElementById('btnSearch')?.addEventListener('click', () => loadSuppliers(1));

    document.getElementById('btnClear')?.addEventListener('click', () => {
        clearSupplierFilters();
        loadSuppliers(1);
    });

    document.getElementById('filter_q')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadSuppliers(1);
    });
}

function init() {
    bindFilters();
    bindPagination(loadSuppliers);
    loadSuppliers(suppliersState.currentPage);
}

export { init };
