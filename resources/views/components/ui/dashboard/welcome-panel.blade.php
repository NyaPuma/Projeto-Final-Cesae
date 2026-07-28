@props([
    'userName' => __('utilizador'),
    'profileLabel',
])

<div class="ui-dashboard-welcome rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-5 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
    <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--text-soft)]">{{ __('Sessão ativa') }}</p>
            <h2 class="mt-2 text-lg font-semibold text-[var(--text)]">
                {{ __('Olá, :name.', ['name' => $userName]) }}
            </h2>
            <p class="mt-2 text-sm text-[var(--text-soft)]">
                {{ __('Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => $profileLabel]) }}
            </p>
        </div>

        <span class="inline-flex w-fit items-center rounded-full border border-primary/20 bg-primary/10 px-3 py-1.5 text-xs font-bold text-primary">
            {{ $profileLabel }} • {{ __('Acesso seguro') }}
        </span>
    </div>
</div>
