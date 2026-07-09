<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased">

    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-10">

        {{-- Background subtil --}}
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-0 h-[520px] w-[520px] -translate-x-1/2 rounded-full bg-black/[0.025] blur-3xl dark:bg-white/[0.025]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,transparent,transparent_40%,rgba(0,0,0,0.015))] dark:bg-[radial-gradient(circle_at_top,transparent,transparent_40%,rgba(255,255,255,0.02))]"></div>
        </div>

        <div class="relative w-full max-w-6xl">
            <div class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] shadow-[0_24px_60px_rgba(0,0,0,0.05)] dark:shadow-[0_24px_60px_rgba(0,0,0,0.45)]">
                <div class="grid lg:grid-cols-[1.05fr_0.95fr]">

                    {{-- Painel Institucional --}}
                    <aside class="relative flex flex-col justify-between border-b border-[var(--border)] bg-[var(--surface-2)] p-10 lg:border-b-0 lg:border-r">
                        <div>
                            <div class="flex items-center gap-3">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-500 opacity-75"></span>
                                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                </span>
                                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">
                                    Sistema de Gestão de Avarias
                                </span>
                            </div>

                            <h1 class="mt-8 max-w-md text-4xl font-semibold leading-tight tracking-tight">
                                Plataforma central para gestão operacional.
                            </h1>

                            <p class="mt-5 max-w-lg text-sm leading-7 text-[var(--text-soft)]">
                                Centralize ocorrências, equipamentos, intervenções técnicas,
                                auditorias, relatórios e documentação da API numa única
                                plataforma desenvolvida para equipas de suporte e manutenção.
                            </p>
                        </div>

                        {{-- Destaques --}}
                        <div class="mt-12 space-y-4">
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-semibold">
                                            Gestão de Tickets
                                        </p>
                                        <p class="mt-2 text-xs leading-6 text-[var(--text-soft)]">
                                            Acompanhe prioridades, estados, SLA e histórico completo das intervenções.
                                        </p>
                                    </div>
                                    <div class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-1 text-[10px] font-semibold uppercase tracking-wide">
                                        Live
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5">
                                <p class="text-sm font-semibold">
                                    Ecossistema Integrado
                                </p>
                                <div class="mt-4 grid grid-cols-2 gap-3 text-xs">
                                    <div class="rounded-xl bg-[var(--surface-2)] p-3">Equipamentos</div>
                                    <div class="rounded-xl bg-[var(--surface-2)] p-3">Calendário</div>
                                    <div class="rounded-xl bg-[var(--surface-2)] p-3">Auditoria</div>
                                    <div class="rounded-xl bg-[var(--surface-2)] p-3">Analytics</div>
                                </div>
                            </div>
                        </div>
                    </aside>

                    {{-- Painel de Autenticação --}}
                    <section class="flex flex-col justify-center p-8 sm:p-10 lg:p-14">
                        <div class="w-full max-w-md mx-auto">
                            <div class="mb-8">
                                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--text-soft)]">
                                    Autenticação
                                </span>
                                <h2 class="mt-3 text-3xl font-semibold tracking-tight">
                                    Bem-vindo.
                                </h2>
                                <p class="mt-3 text-sm leading-6 text-[var(--text-soft)]">
                                    Inicie sessão ou crie uma conta para aceder à plataforma de gestão.
                                </p>
                            </div>

                            {{-- Tabs --}}
                            <div class="mb-8 flex rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-1">
                                <button id="tabLogin" class="flex-1 rounded-lg py-2.5 text-sm font-medium transition-all">
                                    Iniciar sessão
                                </button>
                                <button id="tabRegister" class="flex-1 rounded-lg py-2.5 text-sm font-medium transition-all">
                                    Criar conta
                                </button>
                            </div>

                            {{-- Formulário de Login --}}
                            <form id="loginForm" class="space-y-6">
                                <div class="space-y-2">
                                    <label for="loginEmail" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Endereço de Email
                                    </label>
                                    <input id="loginEmail" name="email" type="email" required placeholder="nome@empresa.pt"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <div class="space-y-2">
                                    <label for="loginPassword" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Palavra-passe
                                    </label>
                                    <input id="loginPassword" name="password" type="password" required placeholder="••••••••"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-xl bg-[var(--text)] px-5 py-3 text-sm font-semibold text-[var(--bg)] transition-all duration-200 hover:opacity-90 active:scale-[0.98]">
                                    Iniciar sessão
                                </button>
                            </form>

                            {{-- Formulário de Registo --}}
                            <form id="registerForm" class="hidden space-y-6">
                                <div class="space-y-2">
                                    <label for="registerName" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Nome Completo
                                    </label>
                                    <input id="registerName" name="name" type="text" required placeholder="João Silva"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <div class="space-y-2">
                                    <label for="registerEmail" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Endereço de Email
                                    </label>
                                    <input id="registerEmail" name="email" type="email" required placeholder="nome@empresa.pt"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <div class="space-y-2">
                                    <label for="registerPassword" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Palavra-passe
                                    </label>
                                    <input id="registerPassword" name="password" type="password" required placeholder="Mínimo de 8 caracteres"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <div class="space-y-2">
                                    <label for="registerPasswordConfirmation" class="block text-xs font-semibold uppercase tracking-[0.14em] text-[var(--text-soft)]">
                                        Confirmar Palavra-passe
                                    </label>
                                    <input id="registerPasswordConfirmation" name="password_confirmation" type="password" required placeholder="Repita a palavra-passe"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm text-[var(--text)] placeholder:text-[var(--text-soft)] outline-none transition-all duration-200 focus:border-[var(--text)] focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5">
                                </div>

                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3 text-sm font-semibold transition-all duration-200 hover:bg-[var(--surface)] active:scale-[0.98]">
                                    Criar conta
                                </button>
                            </form>

                            <div id="authMessage" class="hidden mt-6 rounded-xl border px-4 py-3 text-sm font-medium"></div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Elementos dos Formulários e Tabs
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const tabLogin = document.getElementById('tabLogin');
    const tabRegister = document.getElementById('tabRegister');
    const messageBox = document.getElementById('authMessage');

    // Elementos dos Inputs de Login
    const loginEmail = document.getElementById('loginEmail');
    const loginPassword = document.getElementById('loginPassword');

    // Elementos dos Inputs de Registo
    const registerName = document.getElementById('registerName');
    const registerEmail = document.getElementById('registerEmail');
    const registerPassword = document.getElementById('registerPassword');
    const registerPasswordConfirmation = document.getElementById('registerPasswordConfirmation');

    // Obter Token CSRF
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.content : '';

    /* ----------------------------------------------------------
     * Helpers
     * ---------------------------------------------------------- */

    function buildHeaders(json = true) {
        const headers = {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        };

        if (json) {
            headers['Content-Type'] = 'application/json';
        }

        return headers;
    }

    function setLoading(form, loading) {
        const button = form.querySelector('button[type="submit"]');
        if (!button) return;

        button.disabled = loading;

        if (loading) {
            button.dataset.original = button.innerHTML;
            button.innerHTML = `
                <span class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path>
                    </svg>
                    A processar...
                </span>
            `;
        } else {
            if (button.dataset.original) {
                button.innerHTML = button.dataset.original;
            }
        }
    }

    function showMessage(message, type = 'success') {
        const classes = {
            success: 'mt-6 rounded-xl border border-emerald-200 dark:border-emerald-900 bg-emerald-50 dark:bg-emerald-950/20 px-4 py-3 text-sm text-emerald-700 dark:text-emerald-400 block',
            error: 'mt-6 rounded-xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-950/20 px-4 py-3 text-sm text-red-700 dark:text-red-400 block'
        };

        messageBox.className = classes[type];
        messageBox.textContent = message;
    }

    function clearMessage() {
        messageBox.className = 'hidden';
        messageBox.textContent = '';
    }

    /* ----------------------------------------------------------
     * Tabs
     * ---------------------------------------------------------- */

    function setActiveTab(tab) {
        const isLogin = tab === 'login';

        const activeClass = 'flex-1 rounded-lg bg-white dark:bg-[#1B1B1A] border border-[#E3E3E0] dark:border-[#2A2A28] text-[#1B1B18] dark:text-white font-semibold py-2.5 shadow-sm transition-all';
        const inactiveClass = 'flex-1 rounded-lg text-[#706F6C] dark:text-[#A1A09A] hover:text-[#1B1B18] dark:hover:text-white py-2.5 font-medium transition-colors';

        tabLogin.className = isLogin ? activeClass : inactiveClass;
        tabRegister.className = isLogin ? inactiveClass : activeClass;

        loginForm.classList.toggle('hidden', !isLogin);
        registerForm.classList.toggle('hidden', isLogin);

        clearMessage();
    }

    /* ----------------------------------------------------------
     * Ação de Login
     * ---------------------------------------------------------- */

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearMessage();

        const payload = {
            email: loginEmail.value.trim(),
            password: loginPassword.value
        };

        if (!payload.email || !payload.password) {
            showMessage('Preencha todos os campos.', 'error');
            return;
        }

        setLoading(loginForm, true);

        try {
            const response = await fetch('/login', {
                method: 'POST',
                credentials: 'include',
                headers: buildHeaders(),
                body: JSON.stringify(payload)
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                showMessage(data.message ?? 'Credenciais inválidas.', 'error');
                return;
            }

            localStorage.setItem('api_token', data.token ?? '');

            const expires = new Date();
            expires.setDate(expires.getDate() + 30);
            document.cookie = `api_token=${encodeURIComponent(data.token ?? '')};path=/;expires=${expires.toUTCString()};SameSite=Lax`;

            showMessage('Sessão iniciada com sucesso.');

            setTimeout(() => {
                window.location.replace('/ui');
            }, 400);

        } catch {
            showMessage('Não foi possível contactar o servidor.', 'error');
        } finally {
            setLoading(loginForm, false);
        }
    });

    /* ----------------------------------------------------------
     * Ação de Registo
     * ---------------------------------------------------------- */

    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearMessage();

        if (registerPassword.value !== registerPasswordConfirmation.value) {
            showMessage('As palavras-passe não coincidem.', 'error');
            return;
        }

        const payload = {
            name: registerName.value.trim(),
            email: registerEmail.value.trim(),
            password: registerPassword.value,
            password_confirmation: registerPasswordConfirmation.value
        };

        setLoading(registerForm, true);

        try {
            const response = await fetch('/register', {
                method: 'POST',
                credentials: 'include',
                headers: buildHeaders(),
                body: JSON.stringify(payload)
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                showMessage(data.message ?? 'Não foi possível criar a conta.', 'error');
                return;
            }

            localStorage.setItem('api_token', data.token ?? '');

            const expires = new Date();
            expires.setDate(expires.getDate() + 30);
            document.cookie = `api_token=${encodeURIComponent(data.token ?? '')};path=/;expires=${expires.toUTCString()};SameSite=Lax`;

            showMessage('Conta criada com sucesso.');

            setTimeout(() => {
                window.location.replace('/ui');
            }, 400);

        } catch {
            showMessage('Erro de comunicação com o servidor.', 'error');
        } finally {
            setLoading(registerForm, false);
        }
    });

    /* ----------------------------------------------------------
     * Inicialização de Listeners
     * ---------------------------------------------------------- */

    tabLogin.addEventListener('click', () => setActiveTab('login'));
    tabRegister.addEventListener('click', () => setActiveTab('register'));

    // Configurar o estado inicial da tab
    setActiveTab('login');
});
</script>
