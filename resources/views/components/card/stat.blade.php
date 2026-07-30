{{--
|--------------------------------------------------------------------------
| Card Stat Component
|--------------------------------------------------------------------------
|
| Exibição de métricas, estatísticas e KPIs para dashboards e painéis de controlo.
| • Suporte híbrido: aceita valores por props ou slots nomeados ($labelSlot, $valueSlot, etc.).
| • Validação rigorosa de variantes de cores, alinhamentos e tipos de tendência.
| • Indicadores de tendência acessíveis com rótulos descritivos WCAG e ícones nativos.
| • Tag HTML semântica da raiz e do título customizáveis.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'label' => null,
    'value' => null,
    'trend' => null,
    'icon' => null,
    'trendType' => 'neutral', // 'positive', 'negative', 'neutral', 'up', 'down'
    'align' => 'left',        // 'left', 'center', 'right'
    'variant' => 'default',   // 'default', 'primary', 'success', 'danger', 'warning', 'info'
    'tag' => 'div',           // Tag HTML semântica da raiz ('div', 'article', 'section')
    'labelTag' => 'span',     // Tag HTML para o rótulo ('span', 'p', 'h3', etc.)
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'article', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação da tag do rótulo
    $allowedLabelTags = ['span', 'p', 'h2', 'h3', 'h4', 'h5', 'h6', 'div'];
    $validLabelTag = in_array(mb_strtolower($labelTag), $allowedLabelTags, true) ? mb_strtolower($labelTag) : 'span';

    // Alinhamentos permitidos
    $allowedAligns = ['left', 'center', 'right'];
    $validAlign = in_array(mb_strtolower($align), $allowedAligns, true) ? mb_strtolower($align) : 'left';

    // Normalização e validação de tipos de tendência
    $normalizedTrendType = match(mb_strtolower($trendType)) {
        'up', 'growth', 'success' => 'positive',
        'down', 'decline', 'error' => 'negative',
        default => mb_strtolower($trendType),
    };
    $allowedTrendTypes = ['positive', 'negative', 'neutral'];
    $validTrendType = in_array($normalizedTrendType, $allowedTrendTypes, true) ? $normalizedTrendType : 'neutral';

    // Validação de variantes visuais
    $allowedVariants = ['default', 'primary', 'success', 'danger', 'warning', 'info'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';

    // Resolução unificada de slots e conteúdos
    $iconContent = $icon ?? $iconSlot ?? null;
    $labelContent = $label ?? $labelSlot ?? null;
    $valueContent = $value ?? $valueSlot ?? ($slot->isNotEmpty() ? $slot : null);
    $trendContent = $trend ?? $trendSlot ?? null;

    // Rótulo acessível dinâmico para a tendência
    $trendActionLabel = match($validTrendType) {
        'positive' => 'Aumento',
        'negative' => 'Diminuição',
        default => 'Estável',
    };
    $trendAriaLabel = $trendContent ? "Tendência: {$trendActionLabel} de {$trendContent}" : 'Tendência neutra';
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-stat',
        "ui-card-stat--align-{$validAlign}",
        "ui-card-stat--variant-{$validVariant}",
    ]) }}
>
    {{-- Ícone da Estatística --}}
    @if($iconContent)
        <div class="ui-card-stat__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </div>
    @endif

    {{-- Bloco de Conteúdo (Rótulo, Valor e Tendência) --}}
    <div class="ui-card-stat__content">
        @if($labelContent)
            <{{ $validLabelTag }} class="ui-card-stat__label">
                {{ $labelContent }}
            </{{ $validLabelTag }}>
        @endif

        @if($valueContent)
            <div class="ui-card-stat__value">
                <strong class="ui-card-stat__value-text">{{ $valueContent }}</strong>
            </div>
        @endif

        @if($trendContent)
            <div
                class="ui-card-stat__trend ui-card-stat__trend--{{ $validTrendType }}"
                aria-label="{{ trim($trendAriaLabel) }}"
            >
                <span class="ui-card-stat__trend-indicator" aria-hidden="true">
                    @if($validTrendType === 'positive')
                        <svg class="ui-card-stat__trend-svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L14 8.414V17a1 1 0 11-2 0V8.414l-2.293 2.293a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd" />
                        </svg>
                    @elseif($validTrendType === 'negative')
                        <svg class="ui-card-stat__trend-svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L6 11.586V3a1 1 0 112 0v8.586l2.293-2.293a1 1 0 011.414 1.414l-4 4z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg class="ui-card-stat__trend-svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </span>
                <span class="ui-card-stat__trend-value">
                    {{ $trendContent }}
                </span>
            </div>
        @endif
    </div>
</{{ $validTag }}>
