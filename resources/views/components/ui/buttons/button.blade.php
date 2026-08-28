{{--
|--------------------------------------------------------------------------
| Page Actions Base Button Component Wrapper
|--------------------------------------------------------------------------
|
| Wrapper component for page action buttons with variant, size and weight support.
| • 100% free of inline CSS or JS.
| • Dynamic prop forwarding and global attribute passthrough.
|
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'weight' => 'bold',
    'type' => 'button',
])

<x-ui.page-actions.base-button
    :variant="$variant"
    :size="$size"
    :weight="$weight"
    :type="$type"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.page-actions.base-button>
