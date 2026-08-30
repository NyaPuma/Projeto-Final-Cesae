import { authHeader } from '../../../utils/api.js';
import { getPartFilters } from './dom.js';

const loadError = () => (window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');

function buildSearchParams(page) {
    const filters = getPartFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    if (filters.status) params.append('status', filters.status);
    if (filters.category_id) params.append('category_id', filters.category_id);
    params.append('page', page);

    return params;
}

export async function fetchParts(page) {
    const response = await fetch(`/stock/parts?${buildSearchParams(page).toString()}`, {
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
