{{--
|-------------------------------------------------------------------------- |
| Page Action Create Button Component
|-------------------------------------------------------------------------- |
| Botão de ação rápida otimizado para o Design System, com suporte a
| propriedades flexíveis, slots e ícones dinâmicos.
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
