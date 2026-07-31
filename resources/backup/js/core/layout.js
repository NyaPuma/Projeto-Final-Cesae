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

    // Expose functions globally for inline event handlers
    window.toggleDesktopSidebar = toggleDesktopSidebar;
    window.toggleMobileNav = toggleMobileNav;
    window.closeMobileNav = closeMobileNav;
    window.toggleTheme = toggleTheme;
    window.toggleNotifications = toggleNotifications;
}

function setupEventListeners(logoutUrl) {
    // Logout button delegation
    document.addEventListener('click', (e) => {
        const logoutBtn = e.target.closest('[data-action="logout"]');
        if (logoutBtn) {
            e.preventDefault();
            import('./auth.js').then(({ logout }) => logout(logoutUrl));
        }

        // Mobile nav close
        const closeMobileNavBtn = e.target.closest('[data-action="close-mobile-nav"]');
        if (closeMobileNavBtn) {
            import('./sidebar.js').then(({ closeMobileNav }) => closeMobileNav());
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
            import('./theme.js').then(({ toggleTheme }) => toggleTheme());
        }
    });

    // Language dropdown
    const langSelector = document.getElementById('langSelectorDropdown');
    if (langSelector) {
        langSelector.addEventListener('click', (e) => {
            const dropdown = document.getElementById('langDropdown');
            const btn = document.getElementById('langDropdownBtn');
            if (!dropdown) return;
            const isHidden = dropdown.classList.contains('hidden');
            if (isHidden) {
                dropdown.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                dropdown.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }
        });

        // Close dropdown on outside click
        document.addEventListener('click', (e) => {
            if (!langSelector.contains(e.target)) {
                const dropdown = document.getElementById('langDropdown');
                const btn = document.getElementById('langDropdownBtn');
                if (dropdown) {
                    dropdown.classList.add('hidden');
                }
                if (btn) {
                    btn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    }
}
