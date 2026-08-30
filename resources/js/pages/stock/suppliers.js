import { fetchSuppliers } from './suppliers/api.js';
import { bindPagination, clearSupplierFilters, renderLoadingState } from './suppliers/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderResultsCount, renderSuppliers, showFeedback } from './suppliers/render.js';
import { setCurrentPage, suppliersState } from './suppliers/state.js';
import { authDelete } from '../../utils/api.js';

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

function bindDeleteActions() {
    document.getElementById('suppliersTableBody')?.addEventListener('click', async (event) => {
        const button = event.target.closest('[data-supplier-delete]');
        if (!button) return;

        const id = button.dataset.supplierDelete;
        const name = button.dataset.name || '';

        if (!window.confirm((window.SGM_UI_I18N?.confirmDeleteSupplier || 'Are you sure you want to delete the supplier') + ` "${name}"?`)) return;

        button.disabled = true;

        try {
            const response = await authDelete(`/admin/suppliers/${id}`);
            const data = await response.json().catch(() => ({}));

            if (!response.ok) throw new Error(data.message || (window.SGM_UI_I18N?.genericError || 'Unable to delete the supplier.'));

            loadSuppliers(suppliersState.currentPage);
        } catch (error) {
            showFeedback(error.message, true);
            button.disabled = false;
        }
    });
}

function init() {
    bindFilters();
    bindPagination(loadSuppliers);
    bindDeleteActions();
    loadSuppliers(suppliersState.currentPage);
}

export { init };
