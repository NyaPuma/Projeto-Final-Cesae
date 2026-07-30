{{--
|--------------------------------------------------------------------------
| Page Actions Base Button Component Wrapper
|--------------------------------------------------------------------------
|
| Componente wrapper para botões de ações de página com suporte a variantes, tamanhos e pesos.
| • 100% livre de CSS ou JS inline.
| • Encaminhamento dinâmico de props e atributos globais.
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
