{{--
|-------------------------------------------------------------------------- |
User Profile Card Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente para exibição de detalhes, avatar e metadados do perfil de utilizador.
| • Padronizado com as variáveis CSS oficiais do Tailwind.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'user',
    'translatedProfile',
])

<section class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
    <div class="flex items-center gap-4">
        <div id="displayUserAvatar" class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-lg font-black text-black transition-all">
            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
        </div>
        <div>
            <h2 id="displayUserName" class="text-lg font-semibold text-[var(--text)]">{{ $user->name ?? __('utilizador') }}</h2>
            <p class="text-sm text-[var(--text-soft)]">{{ $user->email ?? 'sem-email@empresa.pt' }}</p>
            <x-ui.text.pill tone="primary" size="xs" class="mt-2">
                {{ $translatedProfile }}
            </x-ui.text.pill>
        </div>
    </div>

    <div class="mt-8 space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
        <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
            <span>{{ __('Estado') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ $user->active ? __('Ativo') : __('Inativo') }}</span>
        </div>
        <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
            <span>{{ __('Última atualização') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '—' }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span>{{ __('Membro desde') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</span>
        </div>
    </div>
</section>
