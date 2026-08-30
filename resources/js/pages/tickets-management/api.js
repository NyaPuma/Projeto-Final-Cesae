import { authHeader } from '../../utils/api.js';
import { getTicketFilters } from './dom.js';

const loadError = () => (window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');

function buildSearchParams(page) {
    const filters = getTicketFilters();
    const params = new URLSearchParams();

    if (filters.q) params.append('q', filters.q);
    if (filters.status) params.append('status', filters.status);
    if (filters.priority) params.append('priority', filters.priority);
    if (filters.dateFrom) params.append('date_from', filters.dateFrom);
    if (filters.dateTo) params.append('date_to', filters.dateTo);
    params.append('page', page);

    return params;
}

export async function fetchTickets(page) {
    const response = await fetch(`/tickets/search?${buildSearchParams(page).toString()}`, {
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
