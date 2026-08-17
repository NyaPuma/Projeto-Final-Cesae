export function getSupplierFilters() {
    return {
        q: document.getElementById('filter_q')?.value.trim() || '',
    };
}

export function clearSupplierFilters() {
    const q = document.getElementById('filter_q');
    if (q) q.value = '';
}

export function getSupplierTableBody() {
    return document.getElementById('suppliersTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getSupplierTableBody();
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
