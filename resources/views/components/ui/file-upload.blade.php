
<!-- resources/views/components/ui/file-upload.blade.php -->
@props(['name' => 'file', 'label' => 'Upload de Imagem', 'multiple' => false])

<div class="file-upload-wrapper w-full">
    @php($previewId = $name . '-preview')
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold mb-2 text-[var(--text)]">{{ $label }}</label>
    @endif

    <div class="relative group border-2 border-dashed border-[var(--border)] rounded-2xl p-6 transition-all hover:border-primary/50 hover:bg-[var(--surface-2)]/50">
        <input
            type="file"
            id="{{ $name }}"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            {{ $multiple ? 'multiple' : '' }}
            data-behavior="image-preview"
            data-preview-target="{{ $previewId }}"
            class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
        >

        <div class="flex flex-col items-center justify-center text-center">
            <div class="mb-3 p-3 rounded-full bg-primary/10 text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <p class="text-sm font-medium text-[var(--text)]">Clique ou arraste para carregar</p>
            <p class="text-xs text-[var(--text-soft)] mt-1">PNG, JPG até 5MB</p>
        </div>
    </div>

    {{-- Pré-visualização --}}
    <div id="{{ $previewId }}" class="ui-upload-preview mt-4"></div>
</div>
