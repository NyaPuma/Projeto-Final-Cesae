{{--
|--------------------------------------------------------------------------
| Page Actions Base Link Component Wrapper
|--------------------------------------------------------------------------
|
| Componente wrapper para links de ações de página com suporte a variantes, tamanhos e pesos.
| • 100% livre de CSS ou JS inline.
| • Encaminhamento dinâmico de props e atributos globais.
|
--}}

@props([
    'href',
    'variant' => 'secondary',
    'size' => 'md',
    'weight' => 'semibold',
])

<x-ui.page-actions.base-link
    :href="$href"
    :variant="$variant"
    :size="$size"
    :weight="$weight"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.page-actions.base-link>
