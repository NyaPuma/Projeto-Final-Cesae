@props([
    'href',
    'label',
    'compact' => false,
])

@php
    $backIcon = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg>';
@endphp

<x-ui.page-actions.base-link
    :href="$href"
    variant="secondary"
    :size="$compact ? 'compact' : 'sm'"
    weight="semibold"
    :icon="$backIcon"
    icon-class="text-(--text-soft)"
    {{ $attributes }}
>
    {{ $label }}
</x-ui.page-actions.base-link>
