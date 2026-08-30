import { authHeader } from '../../utils/api.js';

const loadError = () => (window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');

export async function fetchAudits(page) {
    const response = await fetch(`/admin/audits?page=${page}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        throw new Error(loadError());
    }

    return response.json().catch(() => ({}));
}
