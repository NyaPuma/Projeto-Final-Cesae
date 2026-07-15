<!-- resources/views/components/ui/modal.blade.php -->
@props(['id', 'title'])

<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm hidden" role="dialog" aria-modal="true">
    <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-xl w-full max-w-lg overflow-hidden animate-[fadeIn_0.3s_ease-out]">
        <div class="px-6 py-4 border-b border-[var(--border)] flex justify-between items-center">
            <h3 class="font-bold text-lg text-[var(--text)]">{{ $title }}</h3>
            <button onclick="closeModal('{{ $id }}')" class="text-[var(--text-soft)] hover:text-[var(--text)] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>
