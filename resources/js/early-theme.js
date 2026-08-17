const metaMode = document.querySelector('meta[name="theme-mode"]');
const metaRole = document.querySelector('meta[name="user-role"]');
const serverMode = metaMode ? metaMode.getAttribute('content') : 'light';
const isAdmin = metaRole ? metaRole.getAttribute('content') === 'admin' : false;
const saved = localStorage.getItem('theme');
const root = document.documentElement;

let isDark;

if (isAdmin && saved && saved !== serverMode) {
    // Preferência antiga/estranha do localStorage: o servidor é a fonte da
    // verdade — limpa a chave para o tema guardado comandar sem flash.
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

// Estado colapsado da sidebar aplicado antes do primeiro paint (anti-flash).
// O initSidebar() (deferred, após o paint) aplica as classes finais e remove
// o marcador pre-collapsed.
if (localStorage.getItem('sidebar_collapsed') === 'true') {
    root.classList.add('pre-collapsed');
}
