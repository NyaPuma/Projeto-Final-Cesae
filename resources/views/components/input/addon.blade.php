{{--
|--------------------------------------------------------------------------
| Input Addon Component
|--------------------------------------------------------------------------
|
| Elemento auxiliar, prefixo ou sufixo para Input Groups e formulários.
| • Validação estrita e normalização de variantes, tamanhos, posições e tags HTML.
| • Suporte a aliases de posição intuitivos ('prefix'/'suffix' mapeados para 'start'/'end').
| • Acessibilidade configurável (permite expor texto descritivo a leitores de ecrã se necessário).
| • Resolução unificada de conteúdo (via prop value ou slot).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'variant' => 'default',  // 'default', 'primary', 'muted', 'subtle'
    'size' => 'md',          // 'xs', 'sm', 'md', 'lg', 'xl'
    'position' => 'start',   // 'start', 'end', 'prefix', 'suffix'
    'tag' => 'span',         // Tag HTML semântica ('span', 'div', 'label')
    'ariaHidden' => true,    // Define se o elemento é oculto para leitores de ecrã (ideal para ícones decorativos)
    'value' => null,         // Conteúdo textual opcional alternativo ao slot
])

@php
    // Validação da tag HTML semântica
    $allowedTags = ['span', 'div', 'label'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'span';

    // Validação de variantes visuais
    $allowedVariants = ['default', 'primary', 'muted', 'subtle'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';

    // Validação de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Normalização inteligente de posições (suporte a aliases prefix/suffix)
    $normalizedPosition = match(mb_strtolower($position)) {
        'prefix' => 'start',
        'suffix' => 'end',
        default => mb_strtolower($position),
    };
    $allowedPositions = ['start', 'end'];
    $validPosition = in_array($normalizedPosition, $allowedPositions, true) ? $normalizedPosition : 'start';

    // Resolução unificada de conteúdo (prop value ou slot)
    $content = $value ?? ($slot->isNotEmpty() ? $slot : null);
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-input-addon',
        "ui-input-addon--variant-{$validVariant}",
        "ui-input-addon--size-{$validSize}",
        "ui-input-addon--pos-{$validPosition}",
    ])->merge([
        'aria-hidden' => $ariaHidden ? 'true' : null,
    ]) }}
>
    {{ $content }}
</{{ $validTag }}>
