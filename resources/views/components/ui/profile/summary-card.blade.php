{{--
|-------------------------------------------------------------------------- |
User Profile Card Component (Optimized)
|-------------------------------------------------------------------------- |
| Component for displaying user profile details, avatar and metadata.
| • Standardized with official Tailwind CSS variables.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'user',
    'translatedProfile',
])

<section class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
    <div class="flex items-center gap-4">
        <div id="displayUserAvatar" class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-lg font-black text-[var(--on-primary)] transition-all">
            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
        </div>
        <div>
            <h2 id="displayUserName" class="text-lg font-semibold text-[var(--text)]">{{ $user->name ?? __('common.utilizador') }}</h2>
            <p class="text-sm text-[var(--text-soft)]">{{ $user->email ?? 'sem-email@empresa.pt' }}</p>
            <x-ui.text.pill tone="primary" size="xs" class="mt-2">
                {{ $translatedProfile }}
            </x-ui.text.pill>
        </div>
    </div>

    <div class="mt-8 space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
        <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
            <span>{{ __('common.Estado') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ $user->active ? __('equipment.Ativo') : __('equipment.Inativo') }}</span>
        </div>
        <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
            <span>{{ __('common.Última atualização') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($user->updated_at) ?: '—' }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span>{{ __('common.Membro desde') }}</span>
            <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDate($user->created_at) ?: '—' }}</span>
        </div>
    </div>
</section>
