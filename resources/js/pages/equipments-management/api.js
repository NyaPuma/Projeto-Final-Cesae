import { authHeader } from '../../utils/api.js';
import { getEquipmentFilters } from './dom.js';

function buildSearchParams(page) {
    const filters = getEquipmentFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    if (filters.status) params.append('status', filters.status);
    params.append('page', page);

    return params;
}

export async function fetchEquipments(page) {
    const response = await fetch(`/equipments?${buildSearchParams(page).toString()}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || 'Não foi possível carregar os equipamentos de momento.');
    }

    return response.json().catch(() => ({}));
}
