@props([
    'href',
    'variant' => 'secondary',
    'size' => 'sm',
    'weight' => 'semibold',
    'icon' => null,
    'iconClass' => 'text-(--text-soft)',
])

@php
    $variantClasses = match ($variant) {
        'primary' => 'ui-button ui-button--primary',
        'secondary' => 'ui-button border border-(--border) bg-(--surface) text-(--text) shadow-sm hover:bg-(--surface-2)',
        'accent' => 'ui-button bg-orange-500 text-white shadow-sm hover:bg-orange-600 hover:text-white',
        'success' => 'ui-button bg-emerald-600 text-white shadow-sm hover:bg-emerald-500 hover:text-white',
        'danger' => 'ui-button border border-rose-500/30 bg-rose-500/10 text-rose-500 shadow-sm hover:bg-rose-500/20 hover:text-rose-500',
        'warning' => 'ui-button bg-amber-500 text-black shadow-sm hover:bg-amber-400 hover:text-black',
        'neutral' => 'ui-button bg-(--border) text-(--text) shadow-sm hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-500',
        'dark' => 'ui-button bg-(--text) text-(--surface) shadow-sm hover:opacity-90 hover:text-(--surface)',
        default => 'ui-button border border-(--border) bg-(--surface) text-(--text) shadow-sm hover:bg-(--surface-2)',
    };

    $sizeClasses = match ($size) {
        'xs' => 'ui-button--xs rounded-xl px-3',
        'sm' => 'ui-button--sm rounded-xl px-3.5',
        'md' => 'ui-button--md rounded-2xl px-5',
        'compact' => 'ui-button--xs rounded-2xl px-3 text-sm shadow-none',
        default => 'ui-button--sm rounded-xl px-3.5',
    };

    $weightClasses = match ($weight) {
        'bold' => 'font-bold',
        default => 'font-semibold',
    };
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => trim($variantClasses . ' ' . $sizeClasses . ' ' . $weightClasses)]) }}>
    @if($icon)
        <span class="ui-button__icon {{ $iconClass }}">{!! $icon !!}</span>
    @endif

    <span class="ui-button__label">{{ $slot->isEmpty() ? '' : $slot }}</span>
</a>
