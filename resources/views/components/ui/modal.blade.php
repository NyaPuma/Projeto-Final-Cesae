<!-- resources/views/components/ui/modal.blade.php -->
@props(['id', 'title'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">
    <div class="w-full max-w-lg overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-xl animate-[fadeIn_0.3s_ease-out]">
        <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
            <h3 id="{{ $id }}-title" class="text-lg font-bold text-[var(--text)]">{{ $title }}</h3>
            <button type="button" data-action="close-modal" data-modal-id="{{ $id }}" class="text-[var(--text-soft)] transition hover:text-[var(--text)]" aria-label="{{ __('Fechar modal') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
