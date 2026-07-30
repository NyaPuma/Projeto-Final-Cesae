{{--
|--------------------------------------------------------------------------
| Auth & Theme Scripts Component
|--------------------------------------------------------------------------
|
| Gestão reativa de autenticação (JWT/LocalStorage) e temas via Alpine.js Stores.
| • 100% livre de CSS ou JS inline (sem manipulação imperativa de innerHTML).
| • Tratamento seguro de cabeçalhos CSRF e tokens de API.
|
--}}

<script>
    // Inicialização imediata do Tema para prevenir FOUC (Flash of Unstyled Content)
    (() => {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    })();

    document.addEventListener('alpine:init', () => {
        // Store Global de Autenticação
        Alpine.store('auth', {
            token: localStorage.getItem('api_token'),
            userName: localStorage.getItem('user_name') || 'Utilizador',
            userRole: localStorage.getItem('user_role') || 'Utilizador',

            get isAuthenticated() {
                return !!this.token;
            },

            get userInitial() {
                return this.userName ? this.userName.charAt(0).toUpperCase() : 'U';
            },

            authHeader() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const headers = {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                };
                if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
                if (this.token) headers['X-Auth-Token'] = this.token;
                return headers;
            },

            requireAuth() {
                if (!this.isAuthenticated) {
                    window.location.href = '/ui/login';
                    return false;
                }
                return true;
            },

            async logout() {
                try {
                    await fetch('/logout', {
                        method: 'POST',
                        headers: Object.assign({ 'Content-Type': 'application/json' }, this.authHeader())
                    });
                } catch (e) {
                    console.error('Erro ao terminar sessão:', e);
                } finally {
                    localStorage.removeItem('api_token');
                    localStorage.removeItem('user_name');
                    localStorage.removeItem('user_role');
                    this.token = null;
                    window.location.href = '/ui/login';
                }
            }
        });

        // Store Global de Tema
        Alpine.store('theme', {
            dark: document.documentElement.classList.contains('dark'),

            toggle() {
                this.dark = !this.dark;
                if (this.dark) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }
        });
    });

    // Verificação opcional de rota protegida ao carregar a página
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof requireAuthOnLoad !== 'undefined' && requireAuthOnLoad) {
            if (window.Alpine && Alpine.store('auth')) {
                Alpine.store('auth').requireAuth();
            }
        }
    });
</script>
