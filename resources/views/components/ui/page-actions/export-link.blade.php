{{--
|-------------------------------------------------------------------------- |
Download Link Component (Optimized)
|-------------------------------------------------------------------------- |
| Specialized component for page-level download actions.
| • Standardized with official Tailwind CSS variables.
| • Flexible slot and customizable icon support.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'href',
    'label' => null,
    'variant' => 'secondary',
    'icon' => null,
])

@php
    $defaultDownloadIcon = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 7H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';

    $resolvedIcon = $icon ?? $defaultDownloadIcon;
    $resolvedWeight = $variant === 'accent' ? 'bold' : 'semibold';
    $resolvedIconClass = $variant === 'accent' ? 'text-current' : 'text-[var(--text-soft)]';
@endphp

<x-ui.page-actions.base-link
    :href="$href"
    :variant="$variant"
    size="sm"
    :weight="$resolvedWeight"
    :icon="$resolvedIcon"
    :icon-class="$resolvedIconClass"
    {{ $attributes }}
>
    {{ $label ?? $slot }}
</x-ui.page-actions.base-link>
