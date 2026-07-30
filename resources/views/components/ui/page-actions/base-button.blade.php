{{--
|-------------------------------------------------------------------------- |
Base Button Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente base e reutilizável para botões do Design System.
| • Padronizado com as variáveis CSS oficiais do Tailwind.
| • 100% livre de CSS ou JS inline.
| --}}
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
        'secondary' => 'ui-button border border-[var(--border)] bg-[var(--surface)] text-[var(--text)] shadow-sm hover:bg-[var(--surface-2)]',
        'accent' => 'ui-button bg-orange-500 text-white shadow-sm hover:bg-orange-600 hover:text-white',
        'success' => 'ui-button bg-emerald-600 text-white shadow-sm hover:bg-emerald-500 hover:text-white',
        'danger' => 'ui-button border border-rose-500/30 bg-rose-500/10 text-rose-500 shadow-sm hover:bg-rose-500/20 hover:text-rose-500',
        'warning' => 'ui-button bg-amber-500 text-black shadow-sm hover:bg-amber-400 hover:text-black',
        'neutral' => 'ui-button bg-[var(--border)] text-[var(--text)] shadow-sm hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-500',
        'dark' => 'ui-button bg-[var(--text)] text-[var(--surface)] shadow-sm hover:opacity-90 hover:text-[var(--surface)]',
        default => 'ui-button bg-orange-500 text-white shadow-sm hover:bg-orange-600 hover:text-white',
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
