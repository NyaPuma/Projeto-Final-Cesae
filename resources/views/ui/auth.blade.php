<x-ui.auth.shell
    data-page="auth"
    :title="__('common.Gestão de Avarias')"
    :description="__('dashboard.Aceda ao painel de operação com um ambiente profissional, simples e focado na autenticação.')"
    :highlights="[
        ['title' => __('common.Acesso direto'), 'description' => __('dashboard.Utilize as suas credenciais para entrar no painel principal.')],
        ['title' => __('auth.Sessão protegida'), 'description' => __('auth.A autenticação é processada de forma segura e imediata.')],
    ]"
>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">{{ __('auth.Iniciar sessão') }}</p>
        <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">{{ __('messages.Bem-vindo de volta') }}</h2>
        <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ __('auth.Introduza o seu email e palavra-passe para continuar.') }}</p>
    </div>

    <div id="msg" aria-live="polite" class="mb-6 hidden min-h-[48px] items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 text-sm font-medium text-[var(--text-soft)]"></div>

    <form id="loginForm" class="space-y-5">
        <div>
            <label for="loginEmail" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.Email') }}</label>
            <input id="loginEmail" name="email" type="email" autocomplete="email" required placeholder="{{ __('common.Ex.: joao@empresa.pt') }}" title="{{ __('common.Este campo é obrigatório.') }}"
                class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
        </div>

        <div>
            <label for="loginPassword" class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('auth.Palavra-passe') }}</label>
            <div class="relative">
                <input id="loginPassword" name="password" type="password" autocomplete="current-password" required placeholder="••••••••" title="{{ __('common.Este campo é obrigatório.') }}"
                    class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 pe-12 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                <button type="button" id="togglePassword" class="absolute end-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-primary transition hover:opacity-70">{{ __('common.Mostrar') }}</button>
            </div>
        </div>

        <button type="submit" class="ui-button ui-button--primary group inline-flex w-full items-center justify-center gap-2 rounded-2xl px-4 py-3.5 text-sm font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
            {{ __('messages.Entrar no sistema') }}
                <svg class="h-4 w-4 transition ltr:group-hover:translate-x-1 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </form>
</x-ui.auth.shell>
