{{--
|--------------------------------------------------------------------------
| Input Icon Component
|--------------------------------------------------------------------------
|
| Wrapper decorativo ou interativo para ícones dentro de campos de formulário.
| • Validação estrita e normalização de variantes, tamanhos e posições.
| • Suporte a aliases de posição intuitivos ('prefix'/'suffix' mapeados para 'start'/'end').
| • Tag HTML semântica configurável (permite usar <button> para ícones interativos, ex: mostrar palavra-passe).
| • Acessibilidade flexível (permite desativar aria-hidden se o ícone for interativo).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'position' => 'start',   // 'start', 'end', 'prefix', 'suffix', 'left', 'right'
    'variant' => 'default',  // 'default', 'primary', 'success', 'warning', 'error', 'muted'
    'size' => 'md',          // 'xs', 'sm', 'md', 'lg', 'xl'
    'tag' => 'span',         // Tag raiz: 'span', 'div', 'button', 'a'
    'ariaHidden' => true,    // Define como false caso seja um botão interativo com aria-label
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['span', 'div', 'button', 'a'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'span';

    // Validação estrita de variantes visuais
    $allowedVariants = ['default', 'primary', 'success', 'warning', 'error', 'muted'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';

    // Validação estrita de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Normalização inteligente de posições (suporte a aliases)
    $normalizedPosition = match(mb_strtolower($position)) {
        'prefix', 'left' => 'start',
        'suffix', 'right' => 'end',
        default => mb_strtolower($position),
    };
    $allowedPositions = ['start', 'end'];
    $validPosition = in_array($normalizedPosition, $allowedPositions, true) ? $normalizedPosition : 'start';
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-input-icon',
        "ui-input-icon--pos-{$validPosition}",
        "ui-input-icon--variant-{$validVariant}",
        "ui-input-icon--size-{$validSize}",
    ])->merge([
        'aria-hidden' => $ariaHidden ? 'true' : null,
        'type' => $validTag === 'button' ? 'button' : null,
    ]) }}
>
    {{ $slot }}
</{{ $validTag }}>
