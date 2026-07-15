{{--
|--------------------------------------------------------------------------
| Card Body Component (Otimizado)
|--------------------------------------------------------------------------
|
| O contentor principal de conteúdo do card.
| • Resolução automática de conflitos entre 'flush' (colado) e 'spacing'.
| • Suporte para altura máxima em corpos com scroll dinâmico.
| • Tag HTML configurável para respeitar a semântica de formulários ou secções.
|
--}}

@props([
    'spacing' => 'md',      // 'none', 'xs', 'sm', 'md', 'lg'
    'scrollable' => false,  // Ativa overflow-y se o conteúdo exceder a altura
    'maxHeight' => null,    // Altura máxima (ex: '350px', '20rem') se for scrollable
    'flush' => false,       // Remove padding para tabelas ou gráficos colarem nas bordas
    'tag' => 'div',         // Permite alterar para 'section', 'form' ou 'fieldset'
])

@php
    // Se for 'flush', forçamos o espaçamento a 'none' para evitar conflitos de padding
    $appliedSpacing = $flush ? 'none' : $spacing;

    // Configura estilos inline se houver uma altura máxima definida
    $styles = [];
    if ($scrollable && $maxHeight) {
        $styles[] = "max-height: {$maxHeight}";
    }
@endphp

<{{ $tag }}
    {{ $attributes->class([
        'ui-card-body',
        "ui-card-body--spacing-{$appliedSpacing}",
        'ui-card-body--scrollable' => $scrollable,
        'ui-card-body--flush' => $flush,
    ])->merge($styles ? ['style' => implode('; ', $styles)] : []) }}
>
    {{ $slot }}
</{{ $tag }}>
