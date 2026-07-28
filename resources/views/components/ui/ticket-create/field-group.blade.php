@props([
    'label',
    'required' => false,
])

<div>
    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">
        {{ $label }}@if($required) * @endif
    </label>

    {{ $slot }}
</div>
