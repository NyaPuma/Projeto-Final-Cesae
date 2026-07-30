{{--
|--------------------------------------------------------------------------
| Card Loader Component
|--------------------------------------------------------------------------
|
| Indicador de estados de carregamento para cards, painéis e secções.
| • Suporte a overlay absoluto sobre o contentor pai (ui-card-loader--overlay).
| • Efeito de desfoque opcional no fundo ('blur') para overlays premium.
| • Resolução unificada de texto (prop 'text', slot nomeado '$textSlot' ou slot padrão).
| • Acessibilidade WCAG completa (role="status", aria-live="polite" e fallback 'sr-only').
| • Sanitização estrita de tamanhos ('xs', 'sm', 'md', 'lg', 'xl') e variantes de cor.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'primary',     // 'primary', 'secondary', 'white', 'gray', 'info'
    'text' => null,             // Texto descritivo do carregamento
    'overlay' => false,         // Posicionamento absoluto em sobreposição ao contentor
    'blur' => false,            // Ativa o efeito de fundo desfocado no modo overlay (via classe BEM)
    'tag' => 'div',             // Tag HTML semântica ('div', 'section', 'aside')
    'label' => null,            // Rótulo customizado para leitores de ecrã (fallback se não houver texto)
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'section', 'aside', 'span'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Validação de variantes de cor
    $normalizedVariant = match(mb_strtolower($variant)) {
        'default' => 'primary',
        'neutral', 'grey' => 'gray',
        default => mb_strtolower($variant),
    };
    $allowedVariants = ['primary', 'secondary', 'white', 'gray', 'info'];
    $validVariant = in_array($normalizedVariant, $allowedVariants, true) ? $normalizedVariant : 'primary';

    // Resolução flexível de texto / conteúdo
    $textContent = $text ?? $textSlot ?? ($slot->isNotEmpty() ? $slot : null);

    // Gestão de acessibilidade ARIA e leitores de ecrã
    $srLabel = $label ?? (is_string($textContent) ? $textContent : 'A carregar conteúdo...');
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-loader',
        "ui-card-loader--{$validSize}",
        "ui-card-loader--variant-{$validVariant}",
        'ui-card-loader--overlay' => $overlay,
        'ui-card-loader--blur' => $overlay && $blur,
    ])->merge([
        'role' => 'status',
        'aria-live' => 'polite',
    ]) }}
>
    {{-- Estrutura visual do spinner SVG (estilizado via CSS externo) --}}
    <div class="ui-card-loader__spinner" aria-hidden="true">
        <svg class="ui-card-loader__icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle class="ui-card-loader__track" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
            <path class="ui-card-loader__head" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
    </div>

    {{-- Texto visível ou fallback invisível para leitores de ecrã (Screen Readers) --}}
    @if($textContent)
        <span class="ui-card-loader__text">
            {{ $textContent }}
        </span>
    @else
        <span class="ui-card-loader__sr-only sr-only">
            {{ $srLabel }}
        </span>
    @endif
</{{ $validTag }}>
