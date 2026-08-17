/**
 * Layout Initialization Module
 * Initializes all layout components: sidebar, theme, auth, notifications
 */

import { initSidebar, toggleDesktopSidebar, toggleMobileNav, closeMobileNav } from './sidebar.js';
import { initTheme, toggleTheme } from './theme.js';
import { requireAuth } from './auth.js';
import { renderAuthBox } from './auth-box.js';
import { startNotificationPolling, setupNotificationDropdown, toggleNotifications } from './notifications.js';

export function initLayout(config = {}) {
    const {
        loginUrl = '/login',
        logoutUrl = '/logout',
        profileUrl = '/profile',
        requireAuthOnLoad = false
    } = config;

    // Initialize sidebar state
    initSidebar();

    // Initialize theme
    initTheme();

    // Check authentication if required
    if (requireAuthOnLoad) {
        requireAuth(loginUrl);
    }

    // Render auth boxes
    renderAuthBox(profileUrl, loginUrl);

    // Setup notifications
    setupNotificationDropdown();
    setTimeout(startNotificationPolling, 500);

    // Setup event listeners for inline handlers
    setupEventListeners(logoutUrl);

    // Sync the theme icon with the current mode
    syncThemeIcon();

    // Expose functions globally for inline event handlers
    window.toggleDesktopSidebar = toggleDesktopSidebar;
    window.toggleMobileNav = toggleMobileNav;
    window.closeMobileNav = closeMobileNav;
    window.toggleTheme = toggleTheme;
    window.toggleNotifications = toggleNotifications;
}

function syncThemeIcon() {
    const icon = document.querySelector('[data-theme-icon]');
    if (!icon) return;

    const isDark = document.documentElement.classList.contains('dark');
    icon.textContent = isDark ? '☀️' : '🌙';
}

function closeLanguageDropdown() {
    const dropdown = document.getElementById('langDropdown');
    const btn = document.getElementById('langDropdownBtn');

    if (dropdown) {
        dropdown.classList.remove('active');
    }
    if (btn) {
        btn.setAttribute('aria-expanded', 'false');
    }
}

function setupLanguageDropdown() {
    const langSelector = document.getElementById('langSelectorDropdown');
    const langBtn = document.getElementById('langDropdownBtn');
    const dropdown = document.getElementById('langDropdown');

    if (!langSelector || !langBtn || !dropdown) return;

    // Toggle do painel de idiomas
    langSelector.addEventListener('click', (e) => {
        if (e.target.closest('[data-lang-switch]')) {
            // Os links de idioma apenas navegam; fechar o painel sem tocar no aria do botão
            dropdown.classList.remove('active');
            return;
        }

        const isActive = dropdown.classList.contains('active');

        // Fecha as notificações ao abrir o seletor de idioma
        if (!isActive) {
            const notifDropdown = document.getElementById('notificationDropdown');
            const bellBtn = document.getElementById('notificationBellBtn');
            if (notifDropdown) {
                notifDropdown.classList.remove('active');
            }
            if (bellBtn) {
                bellBtn.setAttribute('aria-expanded', 'false');
            }
        }

        dropdown.classList.toggle('active', !isActive);
        langBtn.setAttribute('aria-expanded', (!isActive).toString());
    });

    // Fechar ao clicar fora
    document.addEventListener('click', (e) => {
        if (!langSelector.contains(e.target)) {
            closeLanguageDropdown();
        }
    });
}

function setupEventListeners(logoutUrl) {
    // Logout button delegation
    document.addEventListener('click', (e) => {
        const logoutBtn = e.target.closest('[data-action="logout"]');
        if (logoutBtn) {
            e.preventDefault();
            import('./auth.js').then(({ logout }) => logout(logoutUrl));
        }

        // Close mobile nav (drawer links)
        const closeMobileNavBtn = e.target.closest('[data-action="close-mobile-nav"]');
        if (closeMobileNavBtn) {
            closeMobileNav();
        }

        // Toggle mobile nav
        const toggleMobileNavBtn = e.target.closest('[data-action="toggle-mobile-nav"]');
        if (toggleMobileNavBtn) {
            import('./sidebar.js').then(({ toggleMobileNav }) => toggleMobileNav());
        }

        // Toggle sidebar
        const toggleSidebarBtn = e.target.closest('[data-action="toggle-sidebar"]');
        if (toggleSidebarBtn) {
            import('./sidebar.js').then(({ toggleDesktopSidebar }) => toggleDesktopSidebar());
        }

        // Toggle theme
        const toggleThemeBtn = e.target.closest('[data-action="toggle-theme"]');
        if (toggleThemeBtn) {
            toggleTheme();
            syncThemeIcon();
        }

        // Toggle notifications
        const toggleNotificationsBtn = e.target.closest('[data-action="toggle-notifications"]');
        if (toggleNotificationsBtn) {
            toggleNotifications();
        }
    });

    setupLanguageDropdown();

    // Fechar painéis com Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLanguageDropdown();

            const notifDropdown = document.getElementById('notificationDropdown');
            const bellBtn = document.getElementById('notificationBellBtn');
            if (notifDropdown) {
                notifDropdown.classList.remove('active');
            }
            if (bellBtn) {
                bellBtn.setAttribute('aria-expanded', 'false');
            }
        }
    });
}
