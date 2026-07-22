/**
 * Sidebar Management Module
 * Gestão do menu lateral (desktop/mobile)
 */

const SIDEBAR_DESKTOP = document.getElementById('desktopSidebar');
const SIDEBAR_MOBILE = document.getElementById('mobileSidebar');
const SIDEBAR_OVERLAY = document.getElementById('sidebarOverlay');

/**
 * Check if sidebar is collapsed
 * @returns {boolean}
 */
export function isSidebarCollapsed() {
    return localStorage.getItem('sidebar_collapsed') === 'true';
}

/**
 * Initialize sidebar state based on localStorage
 */
export function initSidebar() {
    const collapsed = isSidebarCollapsed();
    
    if (collapsed) {
        document.documentElement.classList.add('pre-collapsed');
    }
}

/**
 * Toggle desktop sidebar (collapse/expand)
 */
export function toggleDesktopSidebar() {
    if (!SIDEBAR_DESKTOP) return;
    
    const isCollapsed = !isSidebarCollapsed();
    
    if (isCollapsed) {
        SIDEBAR_DESKTOP.classList.add('w-20');
        SIDEBAR_DESKTOP.classList.remove('w-72');
    } else {
        SIDEBAR_DESKTOP.classList.add('w-72');
        SIDEBAR_DESKTOP.classList.remove('w-20');
    }
    
    localStorage.setItem('sidebar_collapsed', isCollapsed);
    document.documentElement.classList.toggle('pre-collapsed', isCollapsed);
}

/**
 * Toggle mobile sidebar
 */
export function toggleMobileNav() {
    if (!SIDEBAR_MOBILE) return;
    
    SIDEBAR_MOBILE.classList.toggle('-translate-x-full');
    if (SIDEBAR_OVERLAY) {
        SIDEBAR_OVERLAY.classList.toggle('hidden');
    }
}

/**
 * Close mobile navigation
 */
export function closeMobileNav() {
    if (!SIDEBAR_MOBILE) return;
    
    SIDEBAR_MOBILE.classList.add('-translate-x-full');
    if (SIDEBAR_OVERLAY) {
        SIDEBAR_OVERLAY.classList.add('hidden');
    }
}
