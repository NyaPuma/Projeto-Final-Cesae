/**
 * Swagger UI Theme Support
 * 
 * Lightweight theme synchronization for Swagger UI.
 * Does NOT initialize SwaggerUIBundle - that is handled by L5-Swagger's native script.
 * Only handles dark/light mode theme synchronization.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Synchronize dark mode with application preferences
    const isDark = document.documentElement.classList.contains('dark') || 
                   localStorage.getItem('theme') === 'dark' ||
                   (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
    
    if (isDark) {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
        document.body.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.removeAttribute('data-theme');
        document.body.classList.remove('dark');
    }
});
