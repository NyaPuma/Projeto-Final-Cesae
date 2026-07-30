{{--
|--------------------------------------------------------------------------
| Card Icon Component
|--------------------------------------------------------------------------
|
| Responsável por renderizar e estilizar ícones visuais em cards e dashboards.
| • Suporte a múltiplos tamanhos, formatos ('rounded', 'circle', 'square') e estilos.
| • Resolução inteligente de ícones (string SVG, componente Blade, slot ou prop).
| • Tag HTML semântica configurável ('div', 'span', 'i', 'figure').
| • Gestão dinâmica de acessibilidade (aria-hidden decorativo vs. role="img" com rótulo).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'icon' => null,             // Nome do ícone ou string SVG direta
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'primary',     // 'primary', 'secondary', 'success', 'warning', 'danger', 'info', 'gray'
    'shape' => 'rounded',       // 'rounded', 'circle', 'square'
    'styling' => 'subtle',      // 'subtle', 'solid', 'bordered', 'plain'
    'tag' => 'div',             // Tag HTML ('div', 'span', 'i', 'figure')
    'label' => null,            // Rótulo opcional de acessibilidade (para ícones não decorativos)
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'span', 'i', 'figure'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação e normalização de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Normalização e validação de variantes de cor (suporte a aliases comuns)
    $normalizedVariant = match(mb_strtolower($variant)) {
        'error' => 'danger',
        'neutral', 'grey' => 'gray',
        'default' => 'primary',
        default => mb_strtolower($variant),
    };
    $allowedVariants = ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'gray'];
    $validVariant = in_array($normalizedVariant, $allowedVariants, true) ? $normalizedVariant : 'primary';

    // Validação e normalização do formato geométrico (shape)
    $allowedShapes = ['rounded', 'circle', 'square'];
    $validShape = in_array(mb_strtolower($shape), $allowedShapes, true) ? mb_strtolower($shape) : 'rounded';

    // Normalização e validação do estilo visual (styling)
    $normalizedStyling = match(mb_strtolower($styling)) {
        'outline' => 'bordered',
        'flat' => 'subtle',
        default => mb_strtolower($styling),
    };
    $allowedStylings = ['subtle', 'solid', 'bordered', 'plain'];
    $validStyling = in_array($normalizedStyling, $allowedStylings, true) ? $normalizedStyling : 'subtle';

    // Resolução unificada do conteúdo do ícone (prop icon, iconSlot ou slot padrão)
    $iconContent = $icon ?? $iconSlot ?? ($slot->isNotEmpty() ? $slot : null);

    // Gestão dinâmica de acessibilidade ARIA
    $ariaLabel = $label ?? $attributes->get('aria-label');
    $isDecorative = empty($ariaLabel);

    $accessibilityAttributes = [];
    if ($isDecorative) {
        $accessibilityAttributes['aria-hidden'] = 'true';
    } else {
        $accessibilityAttributes['role'] = 'img';
        $accessibilityAttributes['aria-label'] = $ariaLabel;
    }
@endphp

<{{ $validTag }}
    {{ $attributes->merge($accessibilityAttributes)->class([
        'ui-card-icon',
        "ui-card-icon--{$validSize}",
        "ui-card-icon--variant-{$validVariant}",
        "ui-card-icon--shape-{$validShape}",
        "ui-card-icon--style-{$validStyling}",
    ]) }}
>
    @if($iconContent)
        @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
            {!! $iconContent !!}
        @else
            {{ $iconContent }}
        @endif
    @endif
</{{ $validTag }}>
