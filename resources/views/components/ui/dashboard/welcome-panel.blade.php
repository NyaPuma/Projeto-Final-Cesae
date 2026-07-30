{{--
|--------------------------------------------------------------------------
| Dashboard Welcome Banner Component
|--------------------------------------------------------------------------
|
| Banner de boas-vindas para o dashboard com indicação de utilizador e perfil ativo.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Suporte a atributos globais via $attributes.
| • Verificações defensivas robustas para elementos opcionais.
|
--}}

@props([
    'userName' => __('utilizador'),
    'profileLabel' => null,
])

<div {{ $attributes->class(['ui-dashboard-welcome rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-5 shadow-[0_10px_30px_rgba(15,23,42,0.04)]']) }}>
    <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">
                {{ __('Sessão ativa') }}
            </x-ui.text.eyebrow>

            @if($userName)
                <h2 class="mt-2 text-lg font-semibold text-[var(--text)]">
                    {{ __('Olá, :name.', ['name' => $userName]) }}
                </h2>
            @endif

            @if($profileLabel)
                <p class="mt-2 text-sm text-[var(--text-soft)]">
                    {{ __('Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => $profileLabel]) }}
                </p>
            @endif
        </div>

        @if($profileLabel)
            <x-ui.text.pill tone="primary" size="sm" class="font-bold">
                {{ $profileLabel }} • {{ __('Acesso seguro') }}
            </x-ui.text.pill>
        @endif
    </div>
</div>
