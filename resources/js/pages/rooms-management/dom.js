export function getRoomFilters() {
    return {
        q: document.getElementById('filter_q')?.value.trim() || '',
        location: document.getElementById('filter_location')?.value.trim() || '',
    };
}

export function clearRoomFilters() {
    const query = document.getElementById('filter_q');
    const location = document.getElementById('filter_location');

    if (query) query.value = '';
    if (location) location.value = '';
}

export function getRoomsTableBody() {
    return document.getElementById('roomsTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getRoomsTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>';
}

export function bindPagination(handler) {
    getPagination()?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');
        if (!button || button.disabled) return;

        const page = parseInt(button.dataset.page || '', 10);
        if (!Number.isNaN(page)) handler(page);
    });
}
