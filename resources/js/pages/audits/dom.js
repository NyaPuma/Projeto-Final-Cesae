export function getAuditFilters() {
    return {
        q: document.getElementById('filter_q')?.value.toLowerCase().trim() || '',
        event: document.getElementById('filter_event')?.value.toLowerCase() || '',
    };
}

export function clearAuditFilters() {
    const search = document.getElementById('filter_q');
    const event = document.getElementById('filter_event');

    if (search) search.value = '';
    if (event) event.value = '';
}

export function getAuditsTableBody() {
    return document.getElementById('auditsTableBody');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function getEventSelect() {
    return document.getElementById('filter_event');
}

export function renderLoadingState() {
    const tbody = getAuditsTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">' + (window.SGM_AUDIT_I18N?.loading || 'Loading audit records...') + '</td></tr>';
}

export function bindPagination(handler) {
    getPagination()?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');
        if (!button || button.disabled) return;

        const page = parseInt(button.dataset.page || '', 10);
        if (!Number.isNaN(page)) handler(page);
    });
}
