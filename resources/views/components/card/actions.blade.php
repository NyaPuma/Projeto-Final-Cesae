{{--
|--------------------------------------------------------------------------
| Card Actions Component
|--------------------------------------------------------------------------
|
| Área dedicada para ações rápidas, botões e ícones dentro de um card.
| • Suporta posicionamento absoluto (flutuante sobre imagens/conteúdo).
| • Alinhamento flexível e validação semântica de tags HTML.
| • Atribuição automática de acessibilidade ARIA para elementos genéricos.
|
--}}

@props([
    'position' => 'end',  // 'start', 'center', 'end', 'between', 'stretch'
    'gap' => 'sm',         // 'none', 'xs', 'sm', 'md', 'lg'
    'absolute' => false,   // Posição absoluta flutuante sobre o card
    'tag' => 'div',        // 'div', 'header', 'footer', 'aside', etc.
])

@php
    $allowedTags = ['div', 'header', 'footer', 'aside', 'nav', 'section'];
    $elementTag = in_array(strtolower($tag), $allowedTags, true) ? $tag : 'div';
@endphp

<{{ $elementTag }}
    @if($elementTag === 'div' && !$attributes->has('role'))
        role="group"
    @endif
    {{ $attributes->class([
        'ui-card-actions',
        "ui-card-actions--{$position}",
        "ui-card-actions--gap-{$gap}",
        'ui-card-actions--absolute' => $absolute,
    ]) }}
>
    {{ $slot }}
</{{ $elementTag }}>
