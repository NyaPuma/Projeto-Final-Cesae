{{--
|--------------------------------------------------------------------------
| Dashboard Welcome Banner Component
|--------------------------------------------------------------------------
|
| Welcome banner for the dashboard with user name and active profile indicator.
| • 100% free of inline CSS or JS.
| • CSS variable syntax corrected and safe for Tailwind.
| • Global attribute support via $attributes.
| • Robust defensive checks for optional elements.
|
--}}

@props([
    'userName' => __('common.utilizador'),
    'profileLabel' => null,
])

<div {{ $attributes->class(['ui-dashboard-welcome rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)]']) }}>
    <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">
                {{ __('auth.Sessão ativa') }}
            </x-ui.text.eyebrow>

            @if($userName)
                <h1 class="mt-2 text-lg font-semibold text-[var(--text)]">
                    {{ __('common.Olá, :name.', ['name' => $userName]) }}
                </h1>
            @endif

            @if($profileLabel)
                <p class="mt-2 text-sm text-[var(--text-soft)]">
                    {{ __('ticket_media.Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => $profileLabel]) }}
                </p>
            @endif
        </div>

        @if($profileLabel)
            <x-ui.text.pill tone="primary" size="sm" class="font-bold">
                {{ $profileLabel }} • {{ __('common.Acesso seguro') }}
            </x-ui.text.pill>
        @endif
    </div>
</div>
