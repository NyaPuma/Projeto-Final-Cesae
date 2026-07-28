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

export async function persistRoom(formData) {
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/rooms/${id}` : '/api/rooms';

    const response = await fetch(url, {
        method,
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(formData)),
    });

    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        throw new Error(data.message || 'Ocorreu um erro ao guardar a sala.');
    }

    return data;
}
