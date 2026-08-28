{{--
|-------------------------------------------------------------------------- |
Base Button Component (Optimized)
|-------------------------------------------------------------------------- |
| Base reusable component for Design System buttons.
| • Standardized with official Tailwind CSS variables.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'variant' => 'accent',
    'size' => 'sm',
    'weight' => 'bold',
    'icon' => null,
    'iconClass' => 'text-current',
    'type' => 'button',
])

@php
    $variantClasses = match ($variant) {
        'primary' => 'ui-button ui-button--primary',
        'secondary' => 'ui-button border border-solid border-[var(--border)] bg-[var(--surface)] text-[var(--text)] shadow-xs hover:border-[var(--border-hover)] hover:bg-[var(--surface-hover,var(--surface))]',
        'accent' => 'ui-button ui-button--primary',
        'success' => 'ui-button border border-success/30 bg-success/10 text-success shadow-sm hover:bg-success/20',
        'danger' => 'ui-button border border-danger/30 bg-danger/10 text-danger shadow-sm hover:bg-danger/20',
        'warning' => 'ui-button border border-warning/30 bg-warning/10 text-warning shadow-sm hover:bg-warning/20',
        'neutral' => 'ui-button bg-[var(--border)] text-[var(--text)] shadow-sm hover:bg-[var(--surface-hover,var(--surface))]',
        'dark' => 'ui-button bg-[var(--text)] text-[var(--surface)] shadow-sm hover:opacity-90 hover:text-[var(--surface)]',
        default => 'ui-button ui-button--primary',
    };

    $sizeClasses = match ($size) {
        'xs' => 'ui-button--xs rounded-xl px-3',
        'sm' => 'ui-button--sm rounded-xl px-3.5',
        'md' => 'ui-button--md rounded-2xl px-5',
        'compact' => 'ui-button--xs rounded-2xl px-3 text-sm shadow-none',
        default => 'ui-button--sm rounded-xl px-3.5',
    };

    $weightClasses = match ($weight) {
        'semibold' => 'font-semibold',
        default => 'font-bold',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => trim($variantClasses . ' ' . $sizeClasses . ' ' . $weightClasses)]) }}>
    @if($icon)
        <span class="ui-button__icon {{ $iconClass }}">{!! $icon !!}</span>
    @endif

    <span class="ui-button__label">{{ $slot->isEmpty() ? '' : $slot }}</span>
</button>
