import { fetchProfiles, fetchUsers } from './users-management/api.js';
import { appendRoleOption, bindPagination, clearUsersFilters, renderLoadingState } from './users-management/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderResultsCount, renderUsers, showFeedback } from './users-management/render.js';
import { markProfilesLoaded, setCurrentPage, usersState } from './users-management/state.js';

async function ensureProfilesLoaded() {
    if (usersState.profilesLoaded) return;

    const profiles = await fetchProfiles();
    profiles.forEach((profile) => appendRoleOption(profile.name));
    markProfilesLoaded();
}

async function loadUsers(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        await ensureProfilesLoaded();

        const data = await fetchUsers(page);
        if (!data) return;

        const users = data.users?.data ?? data.users ?? [];
        const meta = data.users ?? {};
        const total = meta.meta?.total ?? meta.total ?? users.length;

        renderResultsCount(total);

        if (!users.length) {
            renderEmptyState();
            return;
        }

        renderUsers(users);
        renderPagination(meta, page);
    } catch {
        showFeedback('Erro ao carregar', true);
        renderErrorState();
    }
}

function bindFilters() {
    document.getElementById('btnSearch')?.addEventListener('click', () => loadUsers(1));

    document.getElementById('btnClear')?.addEventListener('click', () => {
        clearUsersFilters();
        loadUsers(1);
    });

    document.getElementById('usersSearch')?.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') loadUsers(1);
    });

    document.getElementById('usersRole')?.addEventListener('change', () => loadUsers(1));
    document.getElementById('usersStatus')?.addEventListener('change', () => loadUsers(1));
}

function init() {
    bindFilters();
    bindPagination(loadUsers);
    loadUsers(usersState.currentPage);
}

export { init };
