import axios from 'axios';
import Pusher from 'pusher-js';

/**
 * CONFIGURAÇÃO AXIOS
 */
const apiClient = axios.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    }
});

// CSRF Token - Apenas em ambiente web tradicional
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
if (csrfToken) {
    apiClient.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}

// Intercetores
apiClient.interceptors.request.use((config) => {
    const token = localStorage.getItem('api_token') || getCookie('api_token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, (error) => Promise.reject(error));

apiClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            handleSessionExpiration();
        }
        return Promise.reject(error);
    }
);

// Expõe globalmente conforme a tua necessidade original
window.axios = apiClient;

/**
 * SERVIÇO DE EVENTOS (PUSHER)
 */
const initPusher = () => {
    const PUSHER_KEY = import.meta.env.VITE_PUSHER_APP_KEY;
    if (!PUSHER_KEY) return;

    const pusher = new Pusher(PUSHER_KEY, {
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1',
        forceTLS: true
    });

    const channel = pusher.subscribe('tickets');

    // Mapeamento de eventos para manter o código DRY (Don't Repeat Yourself)
    const events = [
        { name: 'ticket.created', event: 'ticket-created', msg: 'Novo ticket criado', type: 'warning' },
        { name: 'ticket.status.updated', event: 'ticket-status-updated', msg: 'Status do ticket atualizado', type: 'success' }
    ];

    events.forEach(({ name, event, msg, type }) => {
        channel.bind(name, (data) => {
            if (window.showToast) {
                const message = `${msg}: ${data.equipment_name || data.ticket_id}`;
                window.showToast(message, type);
            }
            window.dispatchEvent(new CustomEvent(event, { detail: data }));
        });
    });
};

initPusher();

/**
 * HELPERS
 */
function handleSessionExpiration() {
    localStorage.removeItem('api_token');
    localStorage.removeItem('user_role');

    window.showToast?.('Sessão expirada. Redirecionando...', 'error');

    setTimeout(() => {
        window.location.href = '/ui/login';
    }, 1500);
}

function getCookie(name) {
    return document.cookie.split('; ').find(row => row.startsWith(`${name}=`))?.split('=')[1] || null;
}

// Global API Helper
window.api = {
    get: (url, cfg) => apiClient.get(url, cfg),
    post: (url, data, cfg) => apiClient.post(url, data, cfg),
    put: (url, data, cfg) => apiClient.put(url, data, cfg),
    patch: (url, data, cfg) => apiClient.patch(url, data, cfg),
    delete: (url, cfg) => apiClient.delete(url, cfg),
};

/**
 * MONITORIZAÇÃO DE REDE
 */
window.addEventListener('offline', () => window.showToast?.('Modo offline ativo.', 'error'));
window.addEventListener('online', () => window.showToast?.('Ligação restabelecida.', 'success'));
