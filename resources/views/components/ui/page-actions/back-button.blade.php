{{--
|-------------------------------------------------------------------------- |
Back Link Component (Optimized)
|-------------------------------------------------------------------------- |
| Specialized component for back-navigation (Back).
| • Standardized with the Design System.
| • Supports native or custom icons via slot/prop.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'href',
    'label' => null,
    'compact' => false,
    'icon' => null,
])

@php
    // Optimized default left-arrow SVG icon
    $defaultBackIcon = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg>';

    $resolvedIcon = $icon ?? $defaultBackIcon;
@endphp

<x-ui.page-actions.base-link
    :href="$href"
    variant="secondary"
    :size="$compact ? 'compact' : 'sm'"
    weight="semibold"
    :icon="$resolvedIcon"
    icon-class="text-[var(--text-soft)]"
    {{ $attributes }}
>
    {{ $label ?? $slot }}
</x-ui.page-actions.base-link>
