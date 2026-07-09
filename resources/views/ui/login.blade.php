@extends('ui.layout')

@section('content')
<div class="flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 min-h-[75vh]">

    {{-- Logo / Nome do Sistema (Alinhado com a Identidade da Sidebar) --}}
    <div class="mb-8 text-center animate-[fadeIn_0.4s_ease-out]">
        <div class="flex items-center justify-center gap-3.5 mb-2">
            <div class="bg-primary h-12 w-12 rounded-xl flex items-center justify-center shadow-md shadow-primary/20">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 00-1 1v1a2 2 0 11-4 0v-1a1 1 0 00-1-1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                </svg>
            </div>
            <div class="text-left">
                <h1 class="text-xl font-bold tracking-tight text-[var(--text)] leading-none">Avarias</h1>
                <p class="text-[10px] uppercase tracking-[0.2em] text-[var(--text-soft)] font-bold mt-1">Gestão & Manutenção</p>
            </div>
        </div>
    </div>

    {{-- Cartão de Login Semântico --}}
    <div class="w-full max-w-md bg-[var(--surface)] rounded-2xl shadow-sm border border-[var(--border)] p-8 sm:p-10 transition-all duration-200">

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-[var(--text)] tracking-tight">Bem-vindo de volta</h2>
            <p class="text-[var(--text-soft)] mt-1.5 text-sm">Insira as suas credenciais para aceder ao painel.</p>
        </div>

        <form id="loginForm" class="space-y-5">
            {{-- Campo: Email --}}
            <div>
                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-2">
                    Endereço de email
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="exemplo@dominio.com"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-[var(--text)]"
                >
            </div>

            {{-- Campo: Palavra-passe --}}
            <div>
                <div class="flex justify-between mb-2">
                    <label for="password" class="text-[11px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        Palavra-passe
                    </label>
                    <a href="#" class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline">
                        Esqueceu-se?
                    </a>
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-[var(--text)]"
                >
            </div>

            {{-- Botão de Submissão Core Accent --}}
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-primary text-black text-sm font-bold rounded-xl shadow-md shadow-primary/10 transition-all duration-200 hover:opacity-95 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer"
            >
                Entrar no Sistema
            </button>
        </form>

        {{-- Feedback Dinâmico Contextual --}}
        <div id="msg" aria-live="polite" class="mt-4 text-center text-xs font-medium transition-all duration-300 min-h-[1.5rem]"></div>

    </div>

    <p class="mt-8 text-[var(--text-soft)] text-xs font-medium">
        &copy; {{ date('Y') }} Central de Operações. Todos os direitos reservados.
    </p>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const msgEl = document.getElementById('msg');

    // Estado: A verificar dados
    msgEl.className = 'mt-4 text-center text-xs font-semibold text-amber-600 dark:text-amber-400 animate-pulse';
    msgEl.innerText = 'A verificar credenciais no servidor...';

    const data = {
        email: form.email.value,
        password: form.password.value
    };

    try {
        const res = await fetch('/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        if (res.status !== 200) {
            const j = await res.json();
            msgEl.className = 'mt-4 text-center text-xs font-bold text-red-600 dark:text-red-400 p-3 bg-red-500/5 rounded-xl border border-red-500/10 animate-[fadeIn_0.2s_ease-out]';
            msgEl.innerText = j.message || 'Credenciais de acesso incorretas.';
            return;
        }

        const j = await res.json();
        localStorage.setItem('api_token', j.token);

        // Atualizar cookie de sessão de forma segura se aplicável
        document.cookie = `api_token=${j.token}; path=/; max-age=86400; SameSite=Lax`;

        msgEl.className = 'mt-4 text-center text-xs font-bold text-emerald-600 dark:text-emerald-400 p-3 bg-emerald-500/5 rounded-xl border border-emerald-500/10 animate-[fadeIn_0.2s_ease-out]';
        msgEl.innerText = 'Autenticação bem-sucedida! A redirecionar...';

        setTimeout(() => {
            window.location = '/ui';
        }, 500);

    } catch (err) {
        msgEl.className = 'mt-4 text-center text-xs font-bold text-red-600 dark:text-red-400 p-3 bg-red-500/5 rounded-xl border border-red-500/10';
        msgEl.innerText = 'Falha crítica na comunicação com o servidor.';
    }
});
</script>
@endpush
