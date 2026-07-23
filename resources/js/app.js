import './api-client';
import './analytics';
import { initTheme } from './core/theme';
import { initSidebar } from './core/sidebar';

/**
 * CORE APPLICATION INITIALIZATION
 */
const App = {
    /**
     * Initialize application
     */
    init() {
        if (!this.checkAuth()) return;

        // Initialize core features
        initTheme();
        initSidebar();

        // Initialize page-specific features
        this.initAuth();
        
        // Initialize management modules based on current route
        if (document.getElementById('equipmentTable')) {
            this.initEquipmentManagement();
        }
        if (document.getElementById('roomsTable')) {
            this.initRoomManagement();
        }

        // Initialize shared UI components
        this.initDropdowns();
        this.initTooltips();
        this.initAnimations();
    },

    // --- SEGURANÇA ---
    checkAuth() {
        const token = localStorage.getItem('auth_token') || this.getCookie('auth_token');
        if (window.requireAuthOnLoad && !token) {
            window.location.href = '/ui/login';
            return false;
        }
        return true;
    },

    getAuthHeaders() {
        const token = localStorage.getItem('auth_token') || this.getCookie('auth_token');
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

    // --- AUTH MODULE ---
    initAuth() {
        import('./pages/auth').then(module => {
            module.initAuth();
        }).catch(err => {
            console.warn('[App] Auth module not loaded:', err);
        });
    },

    // --- MANAGEMENT MODULES ---
    initEquipmentManagement() {
        import('./pages/equipments').then(module => {
            module.initEquipmentManagement();
        }).catch(err => {
            console.warn('[App] Equipment module not loaded:', err);
        });
    },

    initRoomManagement() {
        import('./pages/rooms').then(module => {
            module.initRoomManagement();
        }).catch(err => {
            console.warn('[App] Room module not loaded:', err);
        });
    },

    // --- UI COMPONENTS ---
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
