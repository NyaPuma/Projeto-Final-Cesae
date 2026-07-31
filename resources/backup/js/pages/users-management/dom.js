export function getUsersFilters() {
    return {
        q: document.getElementById('usersSearch')?.value.trim() || '',
        role: document.getElementById('usersRole')?.value || '',
        status: document.getElementById('usersStatus')?.value || '',
    };
}

export function clearUsersFilters() {
    const search = document.getElementById('usersSearch');
    const role = document.getElementById('usersRole');
    const status = document.getElementById('usersStatus');

    if (search) search.value = '';
    if (role) role.value = '';
    if (status) status.value = '';
}

export function getUsersTableBody() {
    return document.getElementById('usersTableBody');
}

export function getUsersRoleSelect() {
    return document.getElementById('usersRole');
}

export function getPagination() {
    return document.getElementById('pagination');
}

export function getResultsCount() {
    return document.getElementById('resultsCount');
}

export function renderLoadingState() {
    const tbody = getUsersTableBody();
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>';
}

export function appendRoleOption(name) {
    const select = getUsersRoleSelect();
    if (!select) return;

    const option = document.createElement('option');
    option.value = name;
    option.textContent = name.toUpperCase();
    select.appendChild(option);
}

export function bindPagination(handler) {
    getPagination()?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');
        if (!button || button.disabled) return;

        const page = parseInt(button.dataset.page || '', 10);
        if (!Number.isNaN(page)) handler(page);
    });
}
