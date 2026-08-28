{{--
|-------------------------------------------------------------------------- |
Page Action Add Link Component (Optimized)
|-------------------------------------------------------------------------- |
| Quick-action component for record creation/addition.
| • Replaces the static character with a professional SVG icon.
| • Supports label via attribute or slot.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'href',
    'label' => null,
    'variant' => 'primary',
    'icon' => '<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>',
])

<x-ui.page-actions.base-link
    :href="$href"
    :variant="$variant"
    size="sm"
    weight="bold"
    :icon="$icon"
    {{ $attributes }}
>
    {{ $label ?? $slot }}
</x-ui.page-actions.base-link>
