import { fetchRooms } from './rooms-management/api.js';
import { bindPagination, clearRoomFilters, renderLoadingState } from './rooms-management/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderResultsCount, renderRooms, showFeedback } from './rooms-management/render.js';
import { roomsState, setCurrentPage } from './rooms-management/state.js';

async function loadRooms(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchRooms(page);
        if (!data) return;

        const rooms = data.rooms?.data ?? data.rooms ?? [];
        const meta = data.rooms ?? {};
        const total = meta.meta?.total ?? meta.total ?? rooms.length;

        renderResultsCount(total);

        if (!rooms.length) {
            renderEmptyState();
            return;
        }

        renderRooms(rooms);
        renderPagination(meta, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function bindFilters() {
    document.getElementById('btnSearch')?.addEventListener('click', () => loadRooms(1));

    document.getElementById('btnClear')?.addEventListener('click', () => {
        clearRoomFilters();
        loadRooms(1);
    });

    document.getElementById('filter_q')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadRooms(1);
    });

    document.getElementById('filter_location')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadRooms(1);
    });
}

function init() {
    bindFilters();
    bindPagination(loadRooms);
    loadRooms(roomsState.currentPage);
}

export { init };
