{{--
|--------------------------------------------------------------------------
| Card Progress Component
|--------------------------------------------------------------------------
|
| Barra de progresso para métricas, estados de conclusão e metas.
| • Gestão e clamping rigoroso de valores (0% - 100% ou min/max customizável).
| • Suporte a estado indeterminado (para carregamentos contínuos).
| • Comunicação de valor via Custom Property CSS (--ui-progress-value) e data-attribute,
|   eliminando 100% de regras CSS inline diretas (ex: width: X%).
| • Resolução flexível de conteúdos (props ou slots nomeados $labelSlot / $valueSlot).
| • Acessibilidade WCAG nativa (role="progressbar" com aria-valuenow).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'value' => 0,               // Valor atual do progresso
    'min' => 0,                 // Valor mínimo (padrão 0)
    'max' => 100,               // Valor máximo (padrão 100)
    'label' => null,            // Rótulo textual acima ou ao lado da barra
    'showValue' => true,        // Apresenta o indicador percentual visível
    'variant' => 'primary',     // 'primary', 'secondary', 'success', 'warning', 'danger', 'info'
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg'
    'animated' => false,        // Ativa animações (stripes, pulse, etc.)
    'indeterminate' => false,   // Ativa o modo indeterminado (loading sem percentagem)
    'tag' => 'div',             // Tag HTML semântica
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'section', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Normalização numérica de limites
    $minVal = (float) $min;
    $maxVal = (float) $max;
    if ($maxVal <= $minVal) {
        $maxVal = $minVal + 100; // Evita divisão por zero ou limites inválidos
    }

    $rawVal = (float) $value;
    $clampedVal = min(max($rawVal, $minVal), $maxVal);

    // Cálculo da percentagem relativa de 0 a 100
    $percentage = (int) round((($clampedVal - $minVal) / ($maxVal - $minVal)) * 100);

    // Validação de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Normalização e validação de variantes
    $normalizedVariant = match(mb_strtolower($variant)) {
        'error' => 'danger',
        'default' => 'primary',
        default => mb_strtolower($variant),
    };
    $allowedVariants = ['primary', 'secondary', 'success', 'warning', 'danger', 'info'];
    $validVariant = in_array($normalizedVariant, $allowedVariants, true) ? $normalizedVariant : 'primary';

    // Resolução de slots e conteúdos
    $labelContent = $label ?? $labelSlot ?? null;
    $valueContent = $valueSlot ?? "{$percentage}%";

    // Atributos dinâmicos de acessibilidade
    $accessibilityAttributes = [
        'role' => 'progressbar',
        'aria-valuemin' => (string) $minVal,
        'aria-valuemax' => (string) $maxVal,
    ];

    if ($indeterminate) {
        $accessibilityAttributes['aria-valuetext'] = 'A carregar...';
    } else {
        $accessibilityAttributes['aria-valuenow'] = (string) round($clampedVal, 2);
        $accessibilityAttributes['aria-valuetext'] = "{$percentage}% concluído";
    }

    if ($labelContent && is_string($labelContent)) {
        $accessibilityAttributes['aria-label'] = $labelContent;
    }
@endphp

<{{ $validTag }}
    {{ $attributes->merge($accessibilityAttributes)->class([
        'ui-card-progress',
        "ui-card-progress--{$validSize}",
        "ui-card-progress--variant-{$validVariant}",
        'ui-card-progress--animated' => $animated,
        'ui-card-progress--indeterminate' => $indeterminate,
    ]) }}
>
    {{-- Cabeçalho da Barra de Progresso: Rótulo e Percentagem --}}
    @if($labelContent || ($showValue && !$indeterminate))
        <div class="ui-card-progress__header">
            @if($labelContent)
                <span class="ui-card-progress__label">
                    {{ $labelContent }}
                </span>
            @endif

            @if($showValue && !$indeterminate)
                <span class="ui-card-progress__value">
                    {{ $valueContent }}
                </span>
            @endif
        </div>
    @endif

    {{-- Calha e Barra Visual de Progresso --}}
    <div class="ui-card-progress__track">
        <div
            class="ui-card-progress__bar"
            data-progress="{{ $percentage }}"
            style="--ui-progress-value: {{ $percentage }}%;"
        ></div>
    </div>
</{{ $validTag }}>
