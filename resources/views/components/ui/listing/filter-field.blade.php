@props([
    'for',
    'label',
    'span' => null,
])

<div @class([$span])>
    <label for="{{ $for }}" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
        {{ $label }}
    </label>

    {{ $slot }}
</div>
