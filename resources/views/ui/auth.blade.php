<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased">
    <div class="pointer-events-none fixed inset-0 -z-10" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute left-1/2 top-0 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-primary/10 blur-[180px]"></div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
    </div>

    <div class="min-h-screen bg-[var(--bg)] px-4 py-6 text-[var(--text)] antialiased sm:px-6 lg:px-8">
        <div class="mx-auto flex min-h-[calc(100vh-3rem)] max-w-5xl items-center justify-center">
            <div class="ui-card w-full overflow-hidden rounded-[32px] border border-[var(--border)] bg-[var(--surface)] shadow-2xl shadow-black/10 backdrop-blur-xl">
                <div class="grid min-h-[720px] lg:grid-cols-[0.95fr_1.05fr]">
                    <div class="flex flex-col justify-between bg-[var(--surface-2)]/70 p-8 lg:p-10">
                        <div>
                            <div class="inline-flex items-center gap-3 rounded-full border border-primary/20 bg-primary/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.24em] text-primary">
                                <span class="h-2 w-2 rounded-full bg-primary"></span>
                                {{ __('Área segura') }}
                            </div>

                            <h1 class="mt-8 text-3xl font-black tracking-tight text-[var(--text)] sm:text-4xl">
                                {{ __('Gestão de Avarias') }}
                            </h1>
                            <p class="mt-4 max-w-md text-sm leading-7 text-[var(--text-soft)] sm:text-[15px]">
                                {{ __('Aceda ao painel de operação com um ambiente profissional, simples e focado na autenticação.') }}
                            </p>
                        </div>

                        <div class="mt-10 space-y-4">
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="text-sm font-semibold text-[var(--text)]">{{ __('Acesso direto') }}</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">{{ __('Utilize as suas credenciais para entrar no painel principal.') }}</p>
                            </div>
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="text-sm font-semibold text-[var(--text)]">{{ __('Sessão protegida') }}</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">{{ __('A autenticação é processada de forma segura e imediata.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center p-6 sm:p-8 lg:p-10">
                        <div class="w-full max-w-md">
                            <div class="mb-8">
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">{{ __('Iniciar sessão') }}</p>
                                <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">{{ __('Bem-vindo de volta') }}</h2>
                                <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ __('Introduza o seu email e palavra-passe para continuar.') }}</p>
                            </div>

                            <div id="msg" aria-live="polite" class="mb-6 hidden min-h-[48px] items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 text-sm font-medium text-[var(--text-soft)]"></div>

                            <form id="loginForm" class="space-y-5">
                                <div>
                                    <label for="loginEmail" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Email') }}</label>
                                    <input id="loginEmail" name="email" type="email" autocomplete="email" required placeholder="utilizador@empresa.pt"
                                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                                </div>

                                <div>
                                    <label for="loginPassword" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Palavra-passe') }}</label>
                                    <div class="relative">
                                        <input id="loginPassword" name="password" type="password" autocomplete="current-password" required placeholder="••••••••"
                                            class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 pr-12 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-primary transition hover:opacity-70">{{ __('Mostrar') }}</button>
                                    </div>
                                </div>

                                <button type="submit" class="ui-button ui-button--primary group inline-flex w-full items-center justify-center gap-2 rounded-2xl px-4 py-3.5 text-sm font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                                    {{ __('Entrar no sistema') }}
                                    <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const togglePasswordBtn = document.getElementById('togglePassword');
        const loginPassword = document.getElementById('loginPassword');
        togglePasswordBtn?.addEventListener('click', () => {
            const isPassword = loginPassword.type === 'password';
            loginPassword.type = isPassword ? 'text' : 'password';
            togglePasswordBtn.textContent = isPassword ? "{{ __('Ocultar') }}" : "{{ __('Mostrar') }}";
        });
    });
    </script>
</body>
</html>
