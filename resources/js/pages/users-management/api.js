import { authHeader } from '../../utils/api.js';
import { getUsersFilters } from './dom.js';

function buildSearchParams(page) {
    const filters = getUsersFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    if (filters.role) params.append('role', filters.role);
    if (filters.status) params.append('status', filters.status);
    params.append('page', page);

    return params;
}

export async function fetchProfiles() {
    const response = await fetch('/admin/profiles', { headers: authHeader() });

    if (!response.ok) {
        return [];
    }

    const data = await response.json().catch(() => ({}));
    return data.profiles || [];
}

export async function fetchUsers(page) {
    const response = await fetch(`/admin/users?${buildSearchParams(page).toString()}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        throw new Error((window.SGM_UI_I18N?.loadError || 'Error loading.'));
    }

    return response.json();
}
