{{--
|-------------------------------------------------------------------------- |
Page Action Add Link Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente de ação rápida para criação/adicionamento de registos.
| • Substitui o caractere estático por um ícone SVG profissional.
| • Suporta rótulo via atributo ou slot.
| • 100% livre de CSS ou JS inline.
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
