import './api-client';
import './analytics';
// 1. Comentados os imports do Echo e Pusher para evitar carregar bibliotecas desnecessárias
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

/**
 * CORE APPLICATION INITIALIZATION
 */
const App = {
    // Configurações e Instâncias
    echo: null,

    init() {
        if (!this.checkAuth()) return;

        this.initTheme();
        this.initSidebar();
        this.initDropdowns();
        this.initTooltips();
        this.initAnimations();

        // 2. Comentada a inicialização do Echo para não disparar o erro
        // this.initEcho();
    },

    // --- SEGURANÇA ---
    checkAuth() {
        const token = localStorage.getItem('api_token') || this.getCookie('api_token');
        if (window.requireAuthOnLoad && !token) {
            window.location.href = '/ui/login';
            return false;
        }
        return true;
    },

    getAuthHeaders() {
        const token = localStorage.getItem('api_token') || this.getCookie('api_token');
        return {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        };
    },

    getCookie(name) {
        return document.cookie.split('; ').reduce((acc, cookie) => {
            const [key, value] = cookie.split('=');
            return key === name ? value : acc;
        }, null);
    },

    // --- PUSHER / ECHO (Desativado) ---
    initEcho() {
        // Mantemos o método vazio ou comentado para evitar que chamadas externas quebrem o JS
        /*
        window.Pusher = Pusher;
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: import.meta.env.VITE_PUSHER_APP_KEY,
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
            forceTLS: true
        });

        const userId = localStorage.getItem('user_id');
        if (userId) {
            this.echo.private(`user.${userId}`)
                .notification((notification) => this.showToast(notification.title, notification.message));
        }
        */
    },

    // --- UI COMPONENTS ---
    initTheme() {
        const isDark = localStorage.getItem('theme') === 'dark' ||
                      (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isDark) document.documentElement.classList.add('dark');
    },

    toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    },

    initSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = () => {
            sidebar?.classList.toggle('-translate-x-full');
            overlay?.classList.toggle('hidden');
        };

        document.querySelectorAll('[data-sidebar-toggle]').forEach(btn => btn.addEventListener('click', toggle));
        overlay?.addEventListener('click', toggle);
    },

    initDropdowns() {
        document.addEventListener('click', (e) => {
            const isButton = e.target.closest('[data-dropdown-button]');
            const allMenus = document.querySelectorAll('[data-dropdown-menu]');

            if (isButton) {
                const menu = isButton.closest('[data-dropdown]').querySelector('[data-dropdown-menu]');
                menu?.classList.toggle('hidden');
            } else {
                allMenus.forEach(m => m.classList.add('hidden'));
            }
        });
    },

    initTooltips() {
        document.querySelectorAll('[data-tooltip]').forEach(el => {
            el.setAttribute('title', el.dataset.tooltip);
        });
    },

    initAnimations() {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.replace('opacity-0', 'opacity-100');
                    entry.target.classList.replace('translate-y-3', 'translate-y-0');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('[data-animate]').forEach(el => {
            el.classList.add('opacity-0', 'translate-y-3', 'transition-all', 'duration-500');
            observer.observe(el);
        });
    },

    showToast(title, message) {
        const toast = document.getElementById('notification-toast');
        if (!toast) return;

        const titleEl = toast.querySelector('#toast-title');
        const msgEl = toast.querySelector('#toast-message');

        if (titleEl) titleEl.textContent = title;
        if (msgEl) msgEl.textContent = message;

        toast.classList.remove('translate-x-[120%]');
        setTimeout(() => toast.classList.add('translate-x-[120%]'), 5000);
    }
};

// Inicialização
document.addEventListener('DOMContentLoaded', () => App.init());

window.App = App;
