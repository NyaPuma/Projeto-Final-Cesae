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

export async function fetchCurrentUser() {
    const response = await fetch('/profile', {
        headers: authHeader(),
    });

    if (!response.ok) {
        return null;
    }

    return response.json().catch(() => null);
}

export async function persistEquipment(formData) {
    const id = formData.get('id');
    const method = id ? 'PATCH' : 'POST';
    const url = id ? `/admin/equipment/${id}` : '/admin/equipment';

    const payload = Object.fromEntries(formData);

    const response = await fetch(url, {
        method,
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
    });

    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        throw new Error(data.message || 'Ocorreu um erro ao guardar o equipamento.');
    }

    return data;
}
