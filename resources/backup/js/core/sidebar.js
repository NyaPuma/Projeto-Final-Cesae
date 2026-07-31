/**
 * Sidebar Management Module
 * Gestão do menu lateral (desktop/mobile)
 */

export function isSidebarCollapsed() {
    return localStorage.getItem('sidebar_collapsed') === 'true';
}

export function toggleDesktopSidebar() {
    const sidebar = document.getElementById('desktopSidebar');
    const wrapper = document.getElementById('mainWrapper');

    if (!sidebar || !wrapper) return;

    const isCollapsed = sidebar.classList.toggle('collapsed');

    if (isCollapsed) {
        wrapper.classList.remove('lg:ml-72');
        wrapper.classList.add('lg:ml-20');
    } else {
        wrapper.classList.remove('lg:ml-20');
        wrapper.classList.add('lg:ml-72');
    }

    localStorage.setItem('sidebar_collapsed', isCollapsed ? 'true' : 'false');
}

export function toggleMobileNav() {
    const overlay = document.getElementById('mobileNavOverlay');
    const drawer = document.getElementById('mobileNav');

    if (!overlay || !drawer) return;

    const isOpen = drawer.classList.contains('translate-x-0');

    if (isOpen) {
        closeMobileNav();
    } else {
        overlay.classList.remove('hidden');
        void overlay.offsetWidth; // Força reflow para animação perfeita
        overlay.classList.remove('opacity-0');
        overlay.classList.add('opacity-100');

        drawer.classList.remove('-translate-x-full');
        drawer.classList.add('translate-x-0');
    }
}

export function closeMobileNav() {
    const overlay = document.getElementById('mobileNavOverlay');
    const drawer = document.getElementById('mobileNav');

    if (!overlay || !drawer) return;

    overlay.classList.remove('opacity-100');
    overlay.classList.add('opacity-0');

    drawer.classList.remove('translate-x-0');
    drawer.classList.add('-translate-x-full');

    setTimeout(() => {
        if (!drawer.classList.contains('translate-x-0')) {
            overlay.classList.add('hidden');
        }
    }, 300);
}

export function initSidebar() {
    const sidebar = document.getElementById('desktopSidebar');
    const wrapper = document.getElementById('mainWrapper');

    const collapsed = isSidebarCollapsed();

    if (sidebar && collapsed) {
        sidebar.classList.add('collapsed');
    }

    if (wrapper) {
        wrapper.classList.toggle('lg:ml-72', !collapsed);
        wrapper.classList.toggle('lg:ml-20', collapsed);
    }

    document.documentElement.classList.remove('pre-collapsed');
}
