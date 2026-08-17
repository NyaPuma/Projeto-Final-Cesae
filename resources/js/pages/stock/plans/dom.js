export function getPlanFilters() {
    return {
        equipment_id: document.getElementById('filter_equipment')?.value || '',
    };
}

export function clearPlanFilters() {
    const equipment = document.getElementById('filter_equipment');
    if (equipment) equipment.value = '';
}

export function getPlanTableBody() {
    return document.getElementById('plansTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getPlanTableBody();
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
