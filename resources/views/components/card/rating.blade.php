{{--
|--------------------------------------------------------------------------
| Card Rating Component
|--------------------------------------------------------------------------
|
| Sistema de avaliação visual (estrelas) para feedback, produtos e KPIs.
| • Suporte a valores decimais / meias estrelas (ex: 3.5, 4.8).
| • Duplo modo: visualização estática (readonly) ou modo interativo com botões.
| • Resolução flexível: valor por prop ou slot, com apresentação opcional da nota.
| • Acessibilidade WCAG completa (role="img" para estático, role="group" para interativo).
| • Sanitização estrita de tamanhos, limites e variantes visuais.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'value' => 0,               // Valor numérico da avaliação (ex: 4, 4.5)
    'max' => 5,                 // Total de estrelas (padrão: 5)
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'warning',     // 'warning' (amarelo), 'primary', 'secondary', 'neutral'
    'readonly' => true,         // Se false, transforma as estrelas em botões interativos
    'showScore' => false,       // Apresenta o texto da nota numérica (ex: 4.5 / 5)
    'label' => null,            // Rótulo textual acessível
    'name' => 'rating',         // Nome do campo (usado nos botões/data attributes quando interativo)
    'tag' => 'div',             // Tag HTML semântica
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'section', 'span'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Normalização numérica de limites
    $maxStars = max(1, (int) $max);
    $rawValue = (float) $value;
    $clampedValue = min(max($rawValue, 0), $maxStars);

    // Validação de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Validação de variantes visuais
    $allowedVariants = ['warning', 'primary', 'secondary', 'neutral'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'warning';

    // Acessibilidade e rótulos
    $formattedScore = number_format($clampedValue, 1, '.', '');
    // Se for inteiro perfeito (ex: 4.0), mostra apenas "4"
    $displayScore = (fmod($clampedValue, 1.0) === 0.0) ? (string) (int) $clampedValue : $formattedScore;

    $defaultA11yLabel = "Classificação: {$displayScore} de {$maxStars} estrelas";
    $ariaLabel = $label ?? $defaultA11yLabel;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-rating',
        "ui-card-rating--{$validSize}",
        "ui-card-rating--variant-{$validVariant}",
        'ui-card-rating--readonly' => $readonly,
        'ui-card-rating--interactive' => !$readonly,
    ])->merge(
        $readonly
            ? ['role' => 'img', 'aria-label' => $ariaLabel]
            : ['role' => 'group', 'aria-label' => $ariaLabel]
    ) }}
>
    <div class="ui-card-rating__stars">
        @for($i = 1; $i <= $maxStars; $i++)
            @php
                // Cálculo do estado de cada estrela (cheia, metade ou vazia)
                $diff = $clampedValue - ($i - 1);

                if ($diff >= 0.75) {
                    $starState = 'full';
                } elseif ($diff >= 0.25) {
                    $starState = 'half';
                } else {
                    $starState = 'empty';
                }
            @endphp

            @if($readonly)
                <span
                    class="ui-card-rating__star ui-card-rating__star--{{ $starState }}"
                    aria-hidden="true"
                >
                    <svg class="ui-card-rating__icon" viewBox="0 0 24 24" aria-hidden="true">
                        @if($starState === 'half')
                            {{-- Estrela Cortada ao Meio (Meia Estrela) --}}
                            <defs>
                                <linearGradient id="ui-rating-half-{{ $loop->index }}">
                                    <stop offset="50%" stop-color="currentColor" />
                                    <stop offset="50%" stop-color="transparent" stop-opacity="1" />
                                </linearGradient>
                            </defs>
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                                fill="url(#ui-rating-half-{{ $loop->index }})"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        @else
                            {{-- Estrela Cheia ou Vazia --}}
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        @endif
                    </svg>
                </span>
            @else
                {{-- Modo Interativo: Renderiza Botões Acessíveis para Seleção --}}
                <button
                    type="button"
                    class="ui-card-rating__button ui-card-rating__star--{{ $starState }}"
                    data-rating-value="{{ $i }}"
                    data-rating-name="{{ $name }}"
                    aria-label="Avaliar com {{ $i }} de {{ $maxStars }} estrelas"
                    aria-pressed="{{ $i <= (int)$clampedValue ? 'true' : 'false' }}"
                >
                    <svg class="ui-card-rating__icon" viewBox="0 0 24 24" aria-hidden="true">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
            @endif
        @endfor
    </div>

    {{-- Apresentação Numérica Opcional da Nota (ex: 4.5 / 5) --}}
    @if($showScore)
        <span class="ui-card-rating__score">
            <strong class="ui-card-rating__score-value">{{ $displayScore }}</strong>
            <span class="ui-card-rating__score-max">/ {{ $maxStars }}</span>
        </span>
    @endif
</{{ $validTag }}>
