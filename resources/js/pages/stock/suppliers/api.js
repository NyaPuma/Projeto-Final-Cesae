import { authHeader } from '../../../utils/api.js';
import { getSupplierFilters } from './dom.js';

function buildSearchParams(page) {
    const filters = getSupplierFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    params.append('page', page);

    return params;
}

export async function fetchSuppliers(page) {
    const response = await fetch(`/stock/suppliers?${buildSearchParams(page).toString()}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || 'Não foi possível carregar os fornecedores de momento.');
    }

    return response.json().catch(() => ({}));
}
