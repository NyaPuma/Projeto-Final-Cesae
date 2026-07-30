{{--
|--------------------------------------------------------------------------
| Card Body Component
|--------------------------------------------------------------------------
|
| O contentor principal de conteúdo do card.
| • Resolução automática de conflitos entre 'flush' (colado) e 'spacing'.
| • Suporte para altura máxima e scroll via classes BEM (zero CSS inline).
| • Validação de tags HTML para garantir a semântica correta no DOM.
|
--}}

@props([
    'spacing' => 'md',      // 'none', 'xs', 'sm', 'md', 'lg'
    'scrollable' => false,  // Ativa overflow-y se o conteúdo exceder a altura
    'maxHeight' => null,    // Variantes de altura máxima ('sm', 'md', 'lg', 'xl') via classes CSS
    'flush' => false,       // Remove padding para tabelas ou gráficos colarem nas bordas
    'tag' => 'div',         // Permite alterar para 'section', 'form', 'fieldset' ou 'article'
])

@php
    // Lista restrita de tags HTML permitidas para garantia de segurança e semântica
    $allowedTags = ['div', 'section', 'form', 'fieldset', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Se for 'flush', forçamos o espaçamento a 'none' para evitar conflitos de padding
    $appliedSpacing = $flush ? 'none' : $spacing;

    // Classe de altura máxima delegada ao CSS em vez de inline styles
    $maxHeightClass = $maxHeight ? "ui-card-body--max-height-{$maxHeight}" : null;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-body',
        "ui-card-body--spacing-{$appliedSpacing}",
        'ui-card-body--scrollable' => $scrollable || $maxHeight !== null,
        'ui-card-body--flush' => $flush,
        $maxHeightClass => $maxHeight !== null,
    ]) }}
>
    {{ $slot }}
</{{ $validTag }}>
