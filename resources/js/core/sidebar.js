/**
 * Sidebar Management Module
 * Gestão do menu lateral (desktop/mobile)
 * NOTA: A lógica principal está no layout.blade.php (inline scripts).
 * Este módulo existe apenas para inicialização do tema e estado inicial.
 */

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
