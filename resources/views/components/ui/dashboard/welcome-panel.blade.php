@props([
    'userName' => __('utilizador'),
    'profileLabel',
])

<div class="ui-dashboard-welcome rounded-2xl border border-(--border) bg-(--surface-2)/70 p-5 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
    <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">{{ __('Sessão ativa') }}</x-ui.text.eyebrow>
            <h2 class="mt-2 text-lg font-semibold text-(--text)">
                {{ __('Olá, :name.', ['name' => $userName]) }}
            </h2>
            <p class="mt-2 text-sm text-(--text-soft)">
                {{ __('Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => $profileLabel]) }}
            </p>
        </div>

        <x-ui.text.pill tone="primary" size="sm" class="font-bold">
            {{ $profileLabel }} • {{ __('Acesso seguro') }}
        </x-ui.text.pill>
    </div>
</div>
