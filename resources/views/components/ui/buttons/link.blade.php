@props([
    'href',
    'variant' => 'secondary',
    'size' => 'md',
    'weight' => 'semibold',
])

<x-ui.page-actions.base-link :href="$href" :variant="$variant" :size="$size" :weight="$weight" {{ $attributes }}>
    {{ $slot }}
</x-ui.page-actions.base-link>
