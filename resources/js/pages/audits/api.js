import { authHeader } from '../../utils/api.js';

export async function fetchAudits(page) {
    const response = await fetch(`/admin/audits?page=${page}`, {
        headers: authHeader(),
    });

    if (response.status === 401) {
        window.location = '/ui/login';
        return null;
    }

    if (!response.ok) {
        throw new Error('Não foi possível carregar os registos de auditoria.');
    }

    return response.json().catch(() => ({}));
}
