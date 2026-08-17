/**
 * Sidebar Management Module
 * Gestão do menu lateral (desktop/mobile)
 */

function setMobileNavExpanded(expanded) {
    document.querySelectorAll('[data-action="toggle-mobile-nav"]').forEach((btn) => {
        btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    });
}

function setMobileNavAriaHidden(hidden) {
    const drawer = document.getElementById('mobileNav');
    if (drawer) {
        drawer.setAttribute('aria-hidden', hidden ? 'true' : 'false');
    }
}

export function isSidebarCollapsed() {
    return localStorage.getItem('sidebar_collapsed') === 'true';
}

export function toggleDesktopSidebar() {
    const sidebar = document.getElementById('desktopSidebar');

    if (!sidebar) return;

    const isCollapsed = sidebar.classList.toggle('collapsed');
    document.body.classList.toggle('sidebar-collapsed', isCollapsed);
    localStorage.setItem('sidebar_collapsed', isCollapsed ? 'true' : 'false');
}

export function toggleMobileNav() {
    const overlay = document.getElementById('mobileNavOverlay');
    const drawer = document.getElementById('mobileNav');

    if (!overlay || !drawer) return;

    const isOpen = drawer.classList.contains('active');

    if (isOpen) {
        closeMobileNav();
    } else {
        overlay.classList.add('active');
        drawer.classList.add('active');
        drawer.setAttribute('aria-hidden', 'false');
        setMobileNavExpanded(true);
    }
}

export function closeMobileNav() {
    const overlay = document.getElementById('mobileNavOverlay');
    const drawer = document.getElementById('mobileNav');

    if (!overlay || !drawer) return;

    overlay.classList.remove('active');
    drawer.classList.remove('active');
    setMobileNavAriaHidden(true);
    setMobileNavExpanded(false);
}

export function initSidebar() {
    const sidebar = document.getElementById('desktopSidebar');
    const collapsed = isSidebarCollapsed();

    if (sidebar && collapsed) {
        sidebar.classList.add('collapsed');
        document.body.classList.add('sidebar-collapsed');
    }

    // O drawer mobile começa sempre fechado em qualquer navegação.
    // Forçar o fecho aqui evita o flash/abertura indesejada na transição
    // de página (e cobre o restore do bfcache, que preserva o DOM).
    closeMobileNav();

    window.addEventListener('pageshow', (event) => {
        if (event.persisted) {
            closeMobileNav();
        }
    });

    document.documentElement.classList.remove('pre-collapsed');
}
