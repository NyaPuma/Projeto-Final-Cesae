@props([
    'variant' => 'primary',
    'size' => 'md',
    'weight' => 'bold',
])

<x-ui.buttons.button type="submit" :variant="$variant" :size="$size" :weight="$weight" {{ $attributes }}>
    {{ $slot }}
</x-ui.buttons.button>
