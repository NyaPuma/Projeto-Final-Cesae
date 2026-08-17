export function getPartFilters() {
    return {
        q: document.getElementById('filter_q')?.value.trim() || '',
        status: document.getElementById('filter_status')?.value || '',
        category_id: document.getElementById('filter_category')?.value || '',
    };
}

export function clearPartFilters() {
    const q = document.getElementById('filter_q');
    const status = document.getElementById('filter_status');
    const category = document.getElementById('filter_category');

    if (q) q.value = '';
    if (status) status.value = '';
    if (category) category.value = '';
}

export function getPartTableBody() {
    return document.getElementById('partsTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getPartTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="7" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>';
}

export function bindPagination(handler) {
    getPagination()?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');
        if (!button || button.disabled) return;

        const page = parseInt(button.dataset.page || '', 10);
        if (!Number.isNaN(page)) handler(page);
    });
}
