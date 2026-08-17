import { fetchParts } from './parts/api.js';
import { bindPagination, clearPartFilters, renderLoadingState } from './parts/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderParts, renderResultsCount, showFeedback } from './parts/render.js';
import { partsState, setCurrentPage } from './parts/state.js';

async function loadParts(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchParts(page);
        if (!data) return;

        const parts = data.parts?.data ?? data.parts ?? [];
        const pagination = data.pagination ?? {};
        const total = pagination.total ?? parts.length;

        renderResultsCount(total);

        if (!parts.length) {
            renderEmptyState();
            return;
        }

        renderParts(parts);
        renderPagination(pagination, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function bindFilters() {
    document.getElementById('btnSearch')?.addEventListener('click', () => loadParts(1));

    document.getElementById('btnClear')?.addEventListener('click', () => {
        clearPartFilters();
        loadParts(1);
    });

    document.getElementById('filter_q')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadParts(1);
    });

    document.getElementById('filter_status')?.addEventListener('change', () => loadParts(1));
    document.getElementById('filter_category')?.addEventListener('change', () => loadParts(1));
}

function init() {
    bindFilters();
    bindPagination(loadParts);
    loadParts(partsState.currentPage);
}

export { init };
