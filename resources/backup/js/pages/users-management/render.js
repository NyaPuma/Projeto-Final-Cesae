import { getPagination, getResultsCount, getUsersTableBody } from './dom.js';

function isUserActive(user) {
    return user.active === true || user.active === 1 || user.active === '1' || String(user.active).toLowerCase() === 'true';
}

function getUserRole(user) {
    return user.profile?.name || user.role || user.profile || '';
}

function renderStatusBadge(user) {
    if (isUserActive(user)) {
        return '<span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-500/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-emerald-600 dark:text-emerald-400"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Ativo</span>';
    }

    return '<span class="inline-flex items-center gap-1.5 rounded-lg bg-[var(--text-soft)]/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-[var(--text-soft)]"><span class="h-1.5 w-1.5 rounded-full bg-[var(--text-soft)]"></span>Inativo</span>';
}

function renderUserRow(user) {
    return `<tr class="transition-colors duration-150 hover:bg-[var(--surface-2)]/50">
        <td class="px-6 py-4 font-mono font-bold text-[var(--text-soft)]">#${user.id}</td>
        <td class="px-6 py-4 font-semibold text-[var(--text)]">${user.name || ''}</td>
        <td class="px-6 py-4 font-semibold text-[var(--text-soft)]">${user.email || ''}</td>
        <td class="px-6 py-4">
            <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-[var(--text)] shadow-sm">${getUserRole(user)}</span>
        </td>
        <td class="px-6 py-4">${renderStatusBadge(user)}</td>
        <td class="px-6 py-4 text-right">
            <a href="/ui/users/${user.id}/edit" class="inline-flex min-h-[28px] items-center justify-center rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-[11px] font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">Editar</a>
        </td>
    </tr>`;
}

export function showFeedback(message, error = false) {
    const element = getResultsCount();
    if (!element) return;

    element.textContent = message;
    element.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

export function renderResultsCount(total) {
    showFeedback(total > 0 ? `${total} resultado(s) encontrado(s)` : 'Sem resultados');
}

export function renderEmptyState() {
    const tbody = getUsersTableBody();
    const pagination = getPagination();

    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-12 text-center text-xs italic text-[var(--text-soft)]">Nenhum utilizador encontrado com os filtros selecionados.</td></tr>';
    }

    if (pagination) pagination.innerHTML = '';
}

export function renderErrorState() {
    const tbody = getUsersTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-12 text-center text-xs font-medium text-[var(--color-danger)]">⚠️ Não foi possível carregar os utilizadores.</td></tr>';
}

export function renderUsers(users) {
    const tbody = getUsersTableBody();
    if (!tbody) return;

    tbody.innerHTML = users.map(renderUserRow).join('');
}

export function renderPagination(meta, currentPage) {
    const pagination = getPagination();
    if (!pagination) return;

    const lastPage = meta.last_page ?? 1;
    const page = meta.current_page ?? currentPage;

    if (lastPage <= 1) {
        pagination.innerHTML = '';
        return;
    }

    pagination.innerHTML = `
        <button data-page="${page - 1}" ${page <= 1 ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">← Anterior</button>
        <span class="font-bold text-[var(--text-soft)]">Página ${page} de ${lastPage}</span>
        <button data-page="${page + 1}" ${page >= lastPage ? 'disabled' : ''}
            class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-40">Próxima →</button>
    `;
}
