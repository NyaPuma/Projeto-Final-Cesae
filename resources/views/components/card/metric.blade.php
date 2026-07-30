{{--
|--------------------------------------------------------------------------
| Card Metric Component
|--------------------------------------------------------------------------
|
| Exibição de KPIs e métricas chave com indicadores de tendência (trend).
| • Suporte híbrido: aceita valores por props ou slots nomeados ($valueSlot, $titleSlot, etc.).
| • Indicadores visuais de tendência ('up', 'down', 'neutral') com ícones SVG nativos.
| • Acessibilidade WCAG completa (aria-label detalhado para leitores de ecrã).
| • Tag HTML semântica customizável ('div', 'article', 'section') e nível de título flexível ('titleTag').
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'title' => null,
    'value' => null,
    'change' => null,          // Percentagem ou valor da mudança (ex: '+12.5%', '-300 €')
    'direction' => 'neutral',   // 'up', 'down', 'neutral'
    'icon' => null,            // Ícone visual do KPI (string SVG, componente ou slot)
    'description' => null,     // Texto descritivo/período (ex: 'em relação ao mês anterior')
    'variant' => 'default',     // 'default', 'outlined', 'flat', 'bordered'
    'tag' => 'div',             // Tag HTML raiz ('div', 'article', 'section')
    'titleTag' => 'h4',        // Tag semântica para o título do KPI ('h1'-'h6', 'span', 'p')
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'article', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação da tag do título (hierarquia WCAG)
    $allowedTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'div', 'p'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h4';

    // Normalização e validação da direção da tendência
    $normalizedDirection = match(mb_strtolower($direction)) {
        'increase', 'growth', 'positive' => 'up',
        'decrease', 'decline', 'negative' => 'down',
        default => mb_strtolower($direction),
    };
    $allowedDirections = ['up', 'down', 'neutral'];
    $validDirection = in_array($normalizedDirection, $allowedDirections, true) ? $normalizedDirection : 'neutral';

    // Validação de variantes visuais
    $allowedVariants = ['default', 'outlined', 'flat', 'bordered'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';

    // Resolução unificada de conteúdos (props ou slots nomeados)
    $iconContent = $icon ?? $iconSlot ?? null;
    $titleContent = $title ?? $titleSlot ?? null;
    $valueContent = $value ?? $valueSlot ?? ($slot->isNotEmpty() ? $slot : null);
    $changeContent = $change ?? $changeSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;

    // Rótulo acessível para leitores de ecrã sobre a tendência
    $trendLabel = match($validDirection) {
        'up' => 'Aumento de ' . (is_string($changeContent) ? $changeContent : ''),
        'down' => 'Diminuição de ' . (is_string($changeContent) ? $changeContent : ''),
        default => 'Estável ' . (is_string($changeContent) ? $changeContent : ''),
    };
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-metric',
        "ui-card-metric--variant-{$validVariant}",
        "ui-card-metric--trend-{$validDirection}",
    ]) }}
>
    {{-- Cabeçalho da Métrica: Ícone e Título --}}
    @if($titleContent || $iconContent)
        <div class="ui-card-metric__header">
            @if($iconContent)
                <div class="ui-card-metric__icon" aria-hidden="true">
                    @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                        {!! $iconContent !!}
                    @else
                        {{ $iconContent }}
                    @endif
                </div>
            @endif

            @if($titleContent)
                <{{ $validTitleTag }} class="ui-card-metric__title">
                    {{ $titleContent }}
                </{{ $validTitleTag }}>
            @endif
        </div>
    @endif

    {{-- Valor Principal do KPI --}}
    @if($valueContent)
        <div class="ui-card-metric__value">
            {{ $valueContent }}
        </div>
    @endif

    {{-- Área de Rodapé da Métrica: Tendência + Descrição --}}
    @if($changeContent || $descriptionContent)
        <div class="ui-card-metric__footer">
            {{-- Indicador de Tendência (Trend) --}}
            @if($changeContent)
                <div class="ui-card-metric__trend" aria-label="{{ trim($trendLabel) }}">
                    <span class="ui-card-metric__trend-icon" aria-hidden="true">
                        @if($validDirection === 'up')
                            <svg class="ui-card-metric__svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L14 8.414V17a1 1 0 11-2 0V8.414l-2.293 2.293a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd" />
                            </svg>
                        @elseif($validDirection === 'down')
                            <svg class="ui-card-metric__svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L6 11.586V3a1 1 0 112 0v8.586l2.293-2.293a1 1 0 011.414 1.414l-4 4z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg class="ui-card-metric__svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </span>
                    <span class="ui-card-metric__trend-value">
                        {{ $changeContent }}
                    </span>
                </div>
            @endif

            {{-- Texto de Contexto / Período --}}
            @if($descriptionContent)
                <p class="ui-card-metric__description">
                    {{ $descriptionContent }}
                </p>
            @endif
        </div>
    @endif
</{{ $validTag }}>
