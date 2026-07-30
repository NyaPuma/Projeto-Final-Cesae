{{--
|--------------------------------------------------------------------------
| Card Actions Group Component
|--------------------------------------------------------------------------
|
| Agrupa múltiplas ações dentro de um card, controlando o layout de forma fluida.
| • Suporta alteração dinâmica de tag (ex: 'footer', 'header', 'nav') para semântica.
| • Atribuição automática de role="group" para tags 'div' não semânticas.
| • Controlo responsivo de alinhamento, espaçamento e quebra de linha.
|
--}}

@props([
    'direction' => 'horizontal', // 'horizontal' ou 'vertical'
    'align' => 'end',            // 'start', 'center', 'end', 'between', 'stretch'
    'spacing' => 'sm',           // 'none', 'xs', 'sm', 'md', 'lg'
    'wrap' => true,              // Permite que os botões quebrem linha em ecrãs móveis
    'tag' => 'div',              // Permite mudar para 'footer', 'header', 'nav', etc.
])

@php
    $allowedTags = ['div', 'footer', 'header', 'nav', 'section'];
    $elementTag = in_array(strtolower($tag), $allowedTags, true) ? $tag : 'div';
@endphp

<{{ $elementTag }}
    @if($elementTag === 'div' && !$attributes->has('role'))
        role="group"
    @endif
    {{ $attributes->class([
        'ui-card-actions-group',
        "ui-card-actions-group--{$direction}",
        "ui-card-actions-group--align-{$align}",
        "ui-card-actions-group--spacing-{$spacing}",
        'ui-card-actions-group--nowrap' => !$wrap,
    ]) }}
>
    {{ $slot }}
</{{ $elementTag }}>
