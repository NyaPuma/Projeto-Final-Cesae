export function getEquipmentFilters() {
    return {
        q: document.getElementById('filter_q')?.value.trim() || '',
        status: document.getElementById('filter_status')?.value || '',
    };
}

export function clearEquipmentFilters() {
    const query = document.getElementById('filter_q');
    const status = document.getElementById('filter_status');

    if (query) query.value = '';
    if (status) status.value = '';
}

export function getEquipmentTableBody() {
    return document.getElementById('equipmentTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function getEquipmentModal() {
    return document.getElementById('equipmentModal');
}

export function getEquipmentForm() {
    return document.getElementById('equipmentForm');
}

export function getAddEquipmentButton() {
    return document.getElementById('btnAddEquipment');
}

export function showAddEquipmentButton() {
    const button = getAddEquipmentButton();
    if (!button) return;

    button.classList.remove('hidden');
    button.classList.add('inline-flex');
}

export function renderLoadingState() {
    const tbody = getEquipmentTableBody();
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
