{{--
|--------------------------------------------------------------------------
| Card Image Placeholder Component
|--------------------------------------------------------------------------
|
| Placeholder visual para estados onde a imagem está ausente ou a carregar.
| • Múltiplos rácios de aspeto ('square', 'video', 'portrait', 'landscape', 'wide') + suporte a rácios numéricos (ex: '16:9').
| • Variantes com suporte a estados de carregamento ('loading') e áreas de upload ('dashed').
| • Gestão dinâmica de acessibilidade (role="img", aria-label e aria-busy automático).
| • Tag HTML semântica customizável ('div', 'figure', 'section').
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'icon' => null,             // Ícone em string SVG, componente Blade ou slot
    'text' => null,             // Texto explicativo do placeholder
    'aspect' => 'square',       // 'square' (1:1), 'video' (16:9), 'portrait' (3:4), 'landscape' (4:3), 'wide' (21:9)
    'variant' => 'default',     // 'default', 'dashed', 'loading'
    'tag' => 'div',             // Tag HTML semântica ('div', 'figure', 'section')
    'label' => null,            // Rótulo customizado para acessibilidade (sobrepõe o padrão)
])

@php
    // Validação da tag HTML raiz
    $allowedTags = ['div', 'figure', 'section', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Normalização e validação dos rácios de aspeto (aceita nomes semânticos e proporções tipo '16:9')
    $normalizedAspect = match(mb_strtolower((string) $aspect)) {
        '1:1', '1/1' => 'square',
        '16:9', '16/9' => 'video',
        '4:3', '4/3' => 'landscape',
        '3:4', '3/4' => 'portrait',
        '21:9', '21/9' => 'wide',
        default => mb_strtolower((string) $aspect),
    };

    $allowedAspects = ['square', 'video', 'portrait', 'landscape', 'wide'];
    $validAspect = in_array($normalizedAspect, $allowedAspects, true) ? $normalizedAspect : 'square';

    // Normalização e validação de variantes (suporte a aliases como 'skeleton' e 'upload')
    $normalizedVariant = match(mb_strtolower($variant)) {
        'skeleton' => 'loading',
        'upload' => 'dashed',
        default => mb_strtolower($variant),
    };

    $allowedVariants = ['default', 'dashed', 'loading'];
    $validVariant = in_array($normalizedVariant, $allowedVariants, true) ? $normalizedVariant : 'default';

    // Resolução flexível do ícone e do texto/conteúdo
    $iconContent = $icon ?? $iconSlot ?? null;
    $textContent = $text ?? $textSlot ?? ($slot->isNotEmpty() ? $slot : null);

    // Definição inteligente do rótulo ARIA para leitores de ecrã
    $defaultLabel = match($validVariant) {
        'loading' => 'A carregar imagem...',
        'dashed' => 'Área para carregamento de imagem',
        default => 'Espaço reservado para imagem',
    };

    $ariaLabel = $label ?? $attributes->get('aria-label') ?? (is_string($textContent) ? $textContent : $defaultLabel);

    // Atributos de acessibilidade
    $accessibilityAttributes = [
        'role' => 'img',
        'aria-label' => $ariaLabel,
    ];

    if ($validVariant === 'loading') {
        $accessibilityAttributes['aria-busy'] = 'true';
        $accessibilityAttributes['aria-live'] = 'polite';
    }
@endphp

<{{ $validTag }}
    {{ $attributes->merge($accessibilityAttributes)->class([
        'ui-card-image-placeholder',
        "ui-card-image-placeholder--aspect-{$validAspect}",
        "ui-card-image-placeholder--variant-{$validVariant}",
    ]) }}
>
    <div class="ui-card-image-placeholder__inner">
        {{-- Área do Ícone / Indicador Visual --}}
        @if($iconContent)
            <div class="ui-card-image-placeholder__icon" aria-hidden="true">
                @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                    {!! $iconContent !!}
                @else
                    {{ $iconContent }}
                @endif
            </div>
        @endif

        {{-- Texto explicativo ou slot livre --}}
        @if($textContent)
            <span class="ui-card-image-placeholder__text">
                {{ $textContent }}
            </span>
        @endif
    </div>
</{{ $validTag }}>
