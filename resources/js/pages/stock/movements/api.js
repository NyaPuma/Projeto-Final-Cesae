import { authHeader, authPost } from '../../../utils/api.js';
import { getMovementFilters } from './dom.js';

const loadError = () => (window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');
const saveError = () => (window.SGM_UI_I18N?.saveError || 'Unable to save the data at the moment.');

function buildSearchParams(page) {
    const filters = getMovementFilters();
    const params = new URLSearchParams();

    if (filters.part_id) params.append('part_id', filters.part_id);
    if (filters.movement_type) params.append('movement_type', filters.movement_type);
    params.append('page', page);

    return params;
}

export async function fetchMovements(page) {
    const response = await fetch(`/stock/movements?${buildSearchParams(page).toString()}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || loadError());
    }

    return response.json().catch(() => ({}));
}

export async function createMovement(payload) {
    const response = await authPost('/stock/movements', payload);

    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        const errorText = data.message || saveError();
        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : '';
        throw new Error(errors ? `${errorText} ${errors}` : errorText);
    }

    return data;
}
