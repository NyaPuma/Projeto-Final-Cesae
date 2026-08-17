import { authHeader } from '../../utils/api.js';
import { getRoomFilters } from './dom.js';

function buildSearchParams(page) {
    const filters = getRoomFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    if (filters.location) params.append('location', filters.location);
    params.append('page', page);

    return params;
}

export async function fetchRooms(page) {
    const response = await fetch(`/api/rooms?${buildSearchParams(page).toString()}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || 'Não foi possível carregar as salas de momento.');
    }

    return response.json().catch(() => ({}));
}
