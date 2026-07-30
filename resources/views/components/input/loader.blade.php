{{--
|--------------------------------------------------------------------------
| Input Loader Component
|--------------------------------------------------------------------------
|
| Spinner SVG acessível e performático para feedback de carregamento.
| • Validação estrita de tamanhos e variantes BEM (sem classes arbitrárias).
| • Acessibilidade WCAG completa (role="status", aria-busy="true", aria-live="polite").
| • Suporte a rótulos acessíveis customizáveis para leitores de ecrã.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'show' => true,
    'size' => 'md',           // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'primary',   // 'primary', 'secondary', 'success', 'warning', 'error', 'neutral', 'muted'
    'label' => 'A carregar',  // Rótulo acessível configurável
])

@php
    // Validação estrita de tamanhos para evitar classes BEM incorretas
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Validação estrita de variantes visuais
    $allowedVariants = ['primary', 'secondary', 'success', 'warning', 'error', 'neutral', 'muted'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'primary';
@endphp

@if($show)
    <span
        {{ $attributes->class([
            'ui-input-loader',
            "ui-input-loader--size-{$validSize}",
            "ui-input-loader--variant-{$validVariant}",
        ])->merge([
            'role' => 'status',
            'aria-busy' => 'true',
            'aria-live' => 'polite',
            'aria-label' => $label,
        ]) }}
    >
        <svg
            class="ui-input-loader__spinner"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 50 50"
            aria-hidden="true"
        >
            <circle
                class="ui-input-loader__track"
                cx="25"
                cy="25"
                r="20"
                fill="none"
                stroke="currentColor"
                stroke-width="4"
                opacity="0.2"
            />
            <circle
                class="ui-input-loader__indicator"
                cx="25"
                cy="25"
                r="20"
                fill="none"
                stroke="currentColor"
                stroke-width="4"
                stroke-linecap="round"
                stroke-dasharray="126"
                stroke-dashoffset="90"
            />
        </svg>
    </span>
@endif
