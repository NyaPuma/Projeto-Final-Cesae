/**
 * Layout Initialization Module
 * Initializes all layout components: sidebar, theme, auth, and
 * the notifications modal.
 */

import { initSidebar, toggleDesktopSidebar, toggleMobileNav, closeMobileNav } from './sidebar.js';
import { initTheme, toggleTheme } from './theme.js';
import { requireAuth } from './auth.js';
import { renderAuthBox } from './auth-box.js';
import { initNotificationsModal } from '../components/notifications-modal.js';

const MOON_ICON = '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg>';
const SUN_ICON = '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>';

export function initLayout(config = {}) {
    const {
        loginUrl = '/login',
        logoutUrl = '/logout',
        profileUrl = '/profile',
        requireAuthOnLoad = false
    } = config;

    initSidebar();
    initTheme();

    if (requireAuthOnLoad) {
        requireAuth(loginUrl);
    }

    renderAuthBox(profileUrl, loginUrl);
    initNotificationsModal();

    setupEventListeners(logoutUrl);
    syncThemeIcon();

    window.toggleDesktopSidebar = toggleDesktopSidebar;
    window.toggleMobileNav = toggleMobileNav;
    window.closeMobileNav = closeMobileNav;
    window.toggleTheme = toggleTheme;
}

function syncThemeIcon() {
    const icon = document.querySelector('[data-theme-icon]');
    if (!icon) return;

    const isDark = document.documentElement.classList.contains('dark');
    icon.innerHTML = isDark ? SUN_ICON : MOON_ICON;
}

function setupEventListeners(logoutUrl) {
    document.addEventListener('click', (e) => {
        const logoutBtn = e.target.closest('[data-action="logout"]');
        if (logoutBtn) {
            e.preventDefault();
            import('./auth.js').then(({ logout }) => logout(logoutUrl));
        }

        const closeMobileNavBtn = e.target.closest('[data-action="close-mobile-nav"]');
        if (closeMobileNavBtn) {
            closeMobileNav();
        }

        const toggleMobileNavBtn = e.target.closest('[data-action="toggle-mobile-nav"]');
        if (toggleMobileNavBtn) {
            import('./sidebar.js').then(({ toggleMobileNav }) => toggleMobileNav());
        }

        const toggleSidebarBtn = e.target.closest('[data-action="toggle-sidebar"]');
        if (toggleSidebarBtn) {
            import('./sidebar.js').then(({ toggleDesktopSidebar }) => toggleDesktopSidebar());
        }

        const toggleThemeBtn = e.target.closest('[data-action="toggle-theme"]');
        if (toggleThemeBtn) {
            toggleTheme();
            syncThemeIcon();
        }
    });
}
