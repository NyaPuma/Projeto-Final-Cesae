{{--
|-------------------------------------------------------------------------- |
| Page Action Create Button Component
|-------------------------------------------------------------------------- |
| Quick-action button optimized for the Design System, with flexible
| properties, slots and dynamic icons.
|--}}
@props([
    'label' => null,
    'variant' => 'accent',
    'icon' => '+',
])

<x-ui.page-actions.base-button :variant="$variant" size="sm" weight="bold" {{ $attributes }}>
    @if($icon)
        <span aria-hidden="true">{{ $icon }}</span>
    @endif
    {{ $label ?? $slot }}
</x-ui.page-actions.base-button>
