export function renderResultsFeedback(element, message, error = false) {
    if (!element) return;

    element.textContent = message;
    element.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

export function renderResultsCount(element, total) {
    renderResultsFeedback(element, total > 0 ? `${total} resultado(s) encontrado(s)` : 'Sem resultados');
}

export function renderTableEmptyState({ tbody, colspan, message }) {
    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="${colspan}" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${message}</div></td></tr>`;
}

export function renderTableErrorState({ tbody, colspan, message }) {
    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="${colspan}" class="px-5 py-12 text-center text-xs font-medium text-[var(--color-danger)]">⚠️ ${message}</td></tr>`;
}

export function renderSimplePagination({ element, meta, currentPage }) {
    if (!element) return;

    const lastPage = meta.last_page ?? 1;
    const page = meta.current_page ?? currentPage;

    if (lastPage <= 1) {
        element.innerHTML = '';
        return;
    }

    element.innerHTML = `
        <button data-page="${page - 1}" ${page <= 1 ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${page} de ${lastPage}</span>
        <button data-page="${page + 1}" ${page >= lastPage ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">Próxima →</button>
    `;
}
