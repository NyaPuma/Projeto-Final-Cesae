/**
 * Theme Management Module
 * Gestão de temas (light/dark) com persistência em localStorage
 */

/**
 * Check if dark mode is enabled by default
 * @returns {boolean}
 */
export function isDarkModeDefault() {
    return localStorage.getItem('theme') === 'dark' ||
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
}

/**
 * Initialize theme based on localStorage or system preference
 */
export function initTheme() {
    const isDark = isDarkModeDefault();
    
    if (isDark) {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.removeAttribute('data-theme');
    }
}

/**
 * Toggle dark mode on/off
 * @returns {boolean} Current theme state after toggle
 */
export function toggleTheme() {
    const isDark = document.documentElement.classList.toggle('dark');
    
    if (isDark) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
    }
    
    return isDark;
}

/**
 * Set theme explicitly
 * @param {'light'|'dark'} theme - Theme to set
 */
export function setTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.removeAttribute('data-theme');
    }
    localStorage.setItem('theme', theme);
}
