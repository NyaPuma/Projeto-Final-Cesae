const metaMode = document.querySelector('meta[name="theme-mode"]');
const metaRole = document.querySelector('meta[name="user-role"]');
const serverMode = metaMode ? metaMode.getAttribute('content') : 'light';
const isAuthenticated = !!metaRole; // any authenticated user has a role meta
const saved = localStorage.getItem('theme');
const root = document.documentElement;

let isDark;

if (isAuthenticated && saved && saved !== serverMode) {
    // Stale/strange localStorage preference: the server is the source of
    // truth — clear the key so the saved theme commands without flash.
    localStorage.removeItem('theme');
    isDark = serverMode === 'dark';
} else if (saved) {
    isDark = saved === 'dark';
} else {
    isDark = serverMode === 'dark';
}

if (isDark) {
    root.classList.add('dark');
    root.setAttribute('data-theme', 'dark');
} else {
    root.classList.remove('dark');
    root.removeAttribute('data-theme');
}

// Collapsed sidebar state applied before first paint (anti-flash).
// initSidebar() (deferred, after paint) applies final classes and removes
// the pre-collapsed marker.
if (localStorage.getItem('sidebar_collapsed') === 'true') {
    root.classList.add('pre-collapsed');
}
