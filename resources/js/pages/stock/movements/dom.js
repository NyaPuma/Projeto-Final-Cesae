export function getMovementFilters() {
    const params = new URLSearchParams(window.location.search);

    return {
        part_id: document.getElementById('filter_part')?.value || params.get('part_id') || '',
        movement_type: document.getElementById('filter_type')?.value || '',
    };
}

export function clearMovementFilters() {
    const part = document.getElementById('filter_part');
    const type = document.getElementById('filter_type');

    if (part) part.value = '';
    if (type) type.value = '';
}

export function getMovementTableBody() {
    return document.getElementById('movementsTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getMovementTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>';
}

export function bindPagination(handler) {
    getPagination()?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');
        if (!button || button.disabled) return;

        const page = parseInt(button.dataset.page || '', 10);
        if (!Number.isNaN(page)) handler(page);
    });
}
