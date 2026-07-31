<!-- resources/views/components/layout/auth-scripts.blade.php -->
<script>
    function authHeader() {
        const token = localStorage.getItem('api_token');
        const headers = {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        if (token) headers['X-Auth-Token'] = token;
        return headers;
    }

    function isAuthenticated() { return !!localStorage.getItem('api_token'); }

    function requireAuth() {
        if (!isAuthenticated()) {
            window.location = '/ui/login';
            return false;
        }
        return true;
    }

    function renderAuthBox() {
        const box = document.getElementById('authBox');
        const topbarUser = document.getElementById('topbarUser');
        if (!box && !topbarUser) return;

        const token = localStorage.getItem('api_token');
        const userName = localStorage.getItem('user_name') || 'Utilizador';
        const userRole = localStorage.getItem('user_role') || 'Utilizador';

        if (token) {
            if (box) {
                box.innerHTML = `
                    <div class="space-y-2">
                        <a href="/ui/profile" class="w-full inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] transition-all duration-200 text-center">Ver Perfil</a>
                        <button onclick="logout()" class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 px-4 py-2.5 text-xs font-semibold text-[var(--text)] cursor-pointer">Terminar Sessão</button>
                    </div>
                `;
            }
            if (topbarUser) {
                topbarUser.innerHTML = `
                    <a href="/ui/profile" class="flex items-center gap-3 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 transition hover:bg-[var(--surface-2)]">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary font-bold text-xs text-black shadow-sm">${userName.charAt(0).toUpperCase()}</div>
                        <div class="hidden md:block">
                            <div class="text-sm font-semibold text-[var(--text)] leading-none">${userName}</div>
                            <div class="mt-1 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">${userRole}</div>
                        </div>
                    </a>
                `;
            }
        } else {
            if (box) box.innerHTML = `<a href="/ui/login" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-black shadow-sm hover:opacity-90 text-center">Iniciar Sessão</a>`;
            if (topbarUser) topbarUser.innerHTML = `<a href="/ui/login" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-black shadow-sm hover:opacity-90">Login / Registo</a>`;
        }
    }

    function logout() {
        fetch('/logout', { method: 'POST', headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()) })
        .finally(() => {
            localStorage.removeItem('api_token');
            localStorage.removeItem('user_name');
            localStorage.removeItem('user_role');
            window.location = '/ui/login';
        });
    }

    function toggleTheme() {
        const dark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', dark ? 'dark' : 'light');
    }

    // Init Theme & Auth
    (() => {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    })();

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof requireAuthOnLoad !== 'undefined' && requireAuthOnLoad) requireAuth();
        renderAuthBox();
    });
</script>
