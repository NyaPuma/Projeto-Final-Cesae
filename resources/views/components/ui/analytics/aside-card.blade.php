@props([
    'label',
    'value',
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-(--border) bg-(--surface-2) px-5 py-4']) }}>
    <x-ui.text.eyebrow tracking="tight">{{ $label }}</x-ui.text.eyebrow>
    <p class="mt-2 text-lg font-bold text-[var(--text)]">{{ $value }}</p>
</div>
