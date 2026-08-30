import { authDelete, authHeader, authPatch, authPost } from '../../../utils/api.js';
import { getPlanFilters } from './dom.js';

const loadError = () => (window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');
const genericError = () => (window.SGM_UI_I18N?.genericError || 'An error occurred.');

function buildSearchParams(page) {
    const filters = getPlanFilters();
    const params = new URLSearchParams();

    if (filters.equipment_id) params.append('equipment_id', filters.equipment_id);
    params.append('page', page);

    return params;
}

export async function fetchPlans(page) {
    const response = await fetch(`/admin/maintenance-plans?${buildSearchParams(page).toString()}`, {
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

export async function fetchPlan(id) {
    const response = await fetch(`/admin/maintenance-plans/${id}`, {
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

export async function createPlan(payload) {
    const response = await authPost('/admin/maintenance-plans', payload);
    return handleResponse(response);
}

export async function updatePlan(id, payload) {
    const response = await authPatch(`/admin/maintenance-plans/${id}`, payload);
    return handleResponse(response);
}

export async function deletePlan(id) {
    const response = await authDelete(`/admin/maintenance-plans/${id}`);
    return handleResponse(response);
}

async function handleResponse(response) {
    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        const errorText = data.message || genericError();
        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : '';
        throw new Error(errors ? `${errorText} ${errors}` : errorText);
    }

    return data;
}
