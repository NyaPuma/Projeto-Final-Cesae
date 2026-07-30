import { fetchAudits } from './audits/api.js';
import { bindPagination, renderLoadingState } from './audits/dom.js';
import { filterAudits, resetAuditFilters } from './audits/filters.js';
import { populateEventFilter, renderAudits, renderEmptyState, renderErrorState, renderPagination, renderResultsCount, showFeedback } from './audits/render.js';
import { auditsState, setCurrentPage } from './audits/state.js';

async function loadAudits(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchAudits(page);
        if (!data) return;

        const paginatedAudits = data.audits?.data ?? [];
        const meta = data.audits ?? {};
        const filteredAudits = filterAudits(paginatedAudits);

        populateEventFilter(paginatedAudits);
        renderResultsCount(filteredAudits.length);

        if (!filteredAudits.length) {
            renderEmptyState();
            renderPagination({ ...meta, last_page: 1, current_page: 1 }, 1);
            return;
        }

        renderAudits(filteredAudits);
        renderPagination(meta, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function bindFilters() {
    const trigger = () => loadAudits(1);

    document.getElementById('btnSearch')?.addEventListener('click', trigger);
    document.getElementById('filter_event')?.addEventListener('change', trigger);
    document.getElementById('filter_q')?.addEventListener('input', trigger);
    document.getElementById('filter_q')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') trigger();
    });

    document.getElementById('btnClear')?.addEventListener('click', () => {
        resetAuditFilters();
        loadAudits(1);
    });
}

function init() {
    bindFilters();
    bindPagination(loadAudits);
    loadAudits(auditsState.currentPage);
}

export { init };
