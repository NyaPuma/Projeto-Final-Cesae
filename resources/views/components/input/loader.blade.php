{{--
|--------------------------------------------------------------------------
| Input Loader Component (Otimizado)
|--------------------------------------------------------------------------
|
| Spinner SVG acessível e performático.
| • role="status" / aria-busy="true".
| • Suporte a tamanhos e variantes via CSS.
|
--}}

@props([
    'show' => true,
    'size' => 'md',
    'variant' => 'primary',
])

@if($show)
    <span
        {{ $attributes->class([
            'ui-input-loader',
            "ui-input-loader--{$size}",
            "ui-input-loader--{$variant}",
        ]) }}
        role="status"
        aria-busy="true"
        aria-live="polite"
        aria-label="A carregar"
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
