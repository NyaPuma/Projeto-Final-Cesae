import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Pusher from 'pusher-js';

const key = import.meta.env.VITE_PUSHER_APP_KEY;

if (key) {
    const pusher = new Pusher(key, {
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1',
        forceTLS: true,
    });

    const channel = pusher.subscribe('tickets');

    channel.bind('ticket.created', (data) => {
        window.dispatchEvent(new CustomEvent('ticket-created', { detail: data }));
    });

    channel.bind('ticket.status.updated', (data) => {
        window.dispatchEvent(new CustomEvent('ticket-status-updated', { detail: data }));
    });
}
