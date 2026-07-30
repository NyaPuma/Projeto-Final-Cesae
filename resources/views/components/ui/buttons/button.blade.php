@props([
    'variant' => 'primary',
    'size' => 'md',
    'weight' => 'bold',
    'type' => 'button',
])

<x-ui.page-actions.base-button :variant="$variant" :size="$size" :weight="$weight" :type="$type" {{ $attributes }}>
    {{ $slot }}
</x-ui.page-actions.base-button>
