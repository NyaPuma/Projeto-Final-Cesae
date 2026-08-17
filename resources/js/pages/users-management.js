import { authHeader } from '../utils/api.js';
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

async function deleteUser(target) {
    const userId = target.dataset.id;
    const userName = target.dataset.name || 'este utilizador';

    if (!window.confirm(`Tem a certeza que pretende apagar o utilizador "${userName}"? Esta ação não pode ser desfeita.`)) {
        return;
    }

    target.disabled = true;

    try {
        const response = await fetch(`/admin/users/${userId}`, {
            method: 'DELETE',
            headers: authHeader(),
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            showFeedback(data.message || 'Não foi possível apagar o utilizador.', true);
            return;
        }

        showFeedback(data.message || 'Utilizador apagado com sucesso.');
        loadUsers(usersState.currentPage);
    } catch {
        showFeedback('Ocorreu um erro ao apagar o utilizador.', true);
    } finally {
        target.disabled = false;
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

function bindDeleteUser() {
    document.addEventListener('click', (event) => {
        const target = event.target.closest('[data-action="delete-user"]');
        if (target) {
            deleteUser(target);
        }
    });
}

function init() {
    bindFilters();
    bindPagination(loadUsers);
    bindDeleteUser();
    loadUsers(usersState.currentPage);
}

export { init };
