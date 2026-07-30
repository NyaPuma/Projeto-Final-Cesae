import { fetchRooms, persistRoom } from './rooms-management/api.js';
import { bindPagination, clearRoomFilters, getRoomForm, renderLoadingState } from './rooms-management/dom.js';
import { bindRoomModalDismiss, closeRoomModal, openRoomModal, reportRoomSaveError } from './rooms-management/modal.js';
import { renderEmptyState, renderErrorState, renderPagination, renderResultsCount, renderRooms, showFeedback } from './rooms-management/render.js';
import { roomsState, setCurrentPage } from './rooms-management/state.js';

async function loadRooms(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchRooms(page);
        if (!data) return;

        const rooms = data.rooms?.data ?? [];
        const meta = data.rooms ?? {};
        const total = meta.total ?? rooms.length;

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

async function handleRoomSave(event) {
    event.preventDefault();

    try {
        await persistRoom(new FormData(event.currentTarget));
        closeRoomModal();
        await loadRooms(roomsState.currentPage);
    } catch (error) {
        reportRoomSaveError(error.message);
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

function bindRoomActions() {
    document.getElementById('btnAddRoom')?.addEventListener('click', openRoomModal);
    getRoomForm()?.addEventListener('submit', handleRoomSave);
}

function init() {
    bindFilters();
    bindRoomActions();
    bindRoomModalDismiss();
    bindPagination(loadRooms);
    loadRooms(roomsState.currentPage);
}

export { init };
