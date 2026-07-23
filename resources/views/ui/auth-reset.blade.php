<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Recuperar Password') }} — {{ __('Gestão de Avarias') }}</title>

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
                                {{ __('Recuperação de Password') }}
                            </h1>
                            <p class="mt-4 max-w-md text-sm leading-7 text-[var(--text-soft)] sm:text-[15px]">
                                {{ __('Introduza o seu email e a nova palavra-passe. O token de recuperação foi enviado para o seu email.') }}
                            </p>
                        </div>

                        <div class="mt-10 space-y-4">
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="text-sm font-semibold text-[var(--text)]">{{ __('Token seguro') }}</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">{{ __('O token expira em 60 minutos por segurança.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center p-6 sm:p-8 lg:p-10">
                        <div class="w-full max-w-md">
                            <div class="mb-8">
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">{{ __('Nova password') }}</p>
                                <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">{{ __('Repor palavra-passe') }}</h2>
                                <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ __('Escolha uma password forte com pelo menos 8 caracteres.') }}</p>
                            </div>

                            <div id="msg" aria-live="polite" class="mb-6 hidden min-h-[48px] items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 text-sm font-medium text-[var(--text-soft)]"></div>

                            <form id="resetForm" class="space-y-5">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div>
                                    <label for="resetEmail" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Email') }}</label>
                                    <input id="resetEmail" name="email" type="email" autocomplete="email" required placeholder="utilizador@empresa.pt"
                                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                                </div>

                                <div>
                                    <label for="resetPassword" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nova Password') }}</label>
                                    <input id="resetPassword" name="password" type="password" autocomplete="new-password" required placeholder="••••••••"
                                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                                </div>

                                <div>
                                    <label for="resetPasswordConfirmation" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Confirmar Password') }}</label>
                                    <input id="resetPasswordConfirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="••••••••"
                                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                                </div>

                                <button type="submit" class="ui-button ui-button--primary group inline-flex w-full items-center justify-center gap-2 rounded-2xl px-4 py-3.5 text-sm font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                                    {{ __('Repor password') }}
                                    <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>

                                <a href="{{ route('ui.login') }}" class="block text-center text-sm font-semibold text-primary transition hover:opacity-70">
                                    {{ __('Voltar ao login') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        const resetForm = document.getElementById('resetForm');
        const msg = document.getElementById('msg');

        function setMsg(message, type) {
            msg.classList.remove('hidden');
            msg.className = 'mb-6 min-h-[48px] items-center justify-center rounded-2xl border px-4 text-sm font-medium flex ' +
                (type === 'error'
                    ? 'border-red-300 bg-red-50 text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-400'
                    : 'border-emerald-300 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400');
            msg.textContent = message;
        }

        function setLoading(loading) {
            const btn = resetForm?.querySelector('button[type="submit"]');
            if (!btn) return;
            btn.disabled = loading;
            btn.classList.toggle('opacity-80', loading);
            btn.classList.toggle('cursor-not-allowed', loading);
            btn.innerHTML = loading
                ? `<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg>${"{{ __('A processar...') }}"}</span>`
                : `${"{{ __('Repor password') }}"} <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
        }

        resetForm?.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = document.getElementById('resetEmail').value;
            const password = document.getElementById('resetPassword').value;
            const passwordConfirmation = document.getElementById('resetPasswordConfirmation').value;
            const token = document.querySelector('input[name="token"]').value;

            if (password !== passwordConfirmation) {
                setMsg("{{ __('As passwords não coincidem.') }}", 'error');
                return;
            }

            if (password.length < 8) {
                setMsg("{{ __('A password deve ter pelo menos 8 caracteres.') }}", 'error');
                return;
            }

            setLoading(true);

            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            try {
                const res = await fetch('/api/password/reset', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {})
                    },
                    body: JSON.stringify({ email, password, password_confirmation: passwordConfirmation, token })
                });

                const j = await res.json().catch(() => ({}));

                if (res.status !== 200) {
                    setMsg(j.message || j.errors?.password?.[0] || "{{ __('Erro ao repor password.') }}", 'error');
                    setLoading(false);
                    return;
                }

                setMsg("{{ __('Password reposta com sucesso! A redirecionar para o login...') }}", 'success');
                setLoading(false);
                setTimeout(() => { window.location.href = '{{ route('ui.login') }}'; }, 2000);
            } catch (err) {
                setMsg("{{ __('Falha na comunicação com o servidor.') }}", 'error');
                setLoading(false);
            }
        });
    })();
    </script>
</body>
</html>
