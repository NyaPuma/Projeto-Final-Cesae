import axios from 'axios';
import Pusher from 'pusher-js';

/* ==========================================================
   CONFIGURAÇÃO BASE DO AXIOS
========================================================== */

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

// Fallback para CSRF (apenas se o meta tag existir em rotas web tradicionais)
const csrf = document.querySelector('meta[name="csrf-token"]');
if (csrf) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf.content;
}

/* ==========================================================
   INTERCETORES AXIOS (SEGURANÇA AUTOMÁTICA & ERROS 401)
========================================================== */

// Intercetor de Pedidos: Injeta o Bearer Token automaticamente em cada chamada Axios
window.axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('api_token') || getCookie('api_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Intercetor de Respostas: Se o servidor responder 401 (Não Autorizado), limpa a sessão local
window.axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            localStorage.removeItem('api_token');
            localStorage.removeItem('user_role');

            if (typeof window.showToast === 'function') {
                window.showToast('Sessão expirada. Por favor, volte a autenticar-se.', 'error');
            }

            setTimeout(() => {
                window.location.href = '/ui/login';
            }, 1500);
        }
        return Promise.reject(error);
    }
);

/* ==========================================================
   REAL-TIME CHANNELS (PUSHER) INTEGRADO COM TOASTS
========================================================== */

const PUSHER_KEY = import.meta.env.VITE_PUSHER_APP_KEY;
const PUSHER_CLUSTER = import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1';

if (PUSHER_KEY) {
    const pusher = new Pusher(PUSHER_KEY, {
        cluster: PUSHER_CLUSTER,
        forceTLS: true
    });

    const channel = pusher.subscribe('tickets');

    // Evento: Novo Ticket Criado
    channel.bind('ticket.created', (data) => {
        if (typeof window.showToast === 'function') {
            window.showToast(`Novo ticket criado para o equipamento: ${data.equipment_name || 'Desconhecido'}`, 'warning');
        }
        window.dispatchEvent(new CustomEvent('ticket-created', { detail: data }));
    });

    // Evento: Atualização de Estado de um Ticket
    channel.bind('ticket.status.updated', (data) => {
        if (typeof window.showToast === 'function') {
            window.showToast(`O ticket #${data.ticket_id} foi alterado para: ${data.status}`, 'success');
        }
        window.dispatchEvent(new CustomEvent('ticket-status-updated', { detail: data }));
    });

    channel.bind('pusher:subscription_succeeded', () => {
        console.info('Ligado ao canal de websockets "tickets".');
    });

    channel.bind('pusher:subscription_error', (status) => {
        console.error('Erro na subscrição do canal de notificações em tempo real:', status);
    });
}

/* ==========================================================
   GLOBAL API HELPERS (INCLUINDO MUTAÇÕES PATCH)
========================================================== */

window.api = {
    get(url, config = {}) {
        return window.axios.get(url, config);
    },
    post(url, data = {}, config = {}) {
        return window.axios.post(url, data, config);
    },
    put(url, data = {}, config = {}) {
        return window.axios.put(url, data, config);
    },
    // CORREÇÃO CRÍTICA: Adicionado suporte ao método PATCH para as tuas rotas do Backoffice
    patch(url, data = {}, config = {}) {
        return window.axios.patch(url, data, config);
    },
    delete(url, config = {}) {
        return window.axios.delete(url, config);
    }
};

/* ==========================================================
   MONITORIZAÇÃO DE ESTADO DA REDE (NETWORK STATUS)
========================================================== */

window.addEventListener('offline', () => {
    if (typeof window.showToast === 'function') {
        window.showToast('Ligação à Internet perdida. Modo offline ativo.', 'error');
    }
});

window.addEventListener('online', () => {
    if (typeof window.showToast === 'function') {
        window.showToast('Ligação restabelecida com sucesso.', 'success');
    }
});

/* ==========================================================
   HELPERS INTERNOS
========================================================== */

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}
