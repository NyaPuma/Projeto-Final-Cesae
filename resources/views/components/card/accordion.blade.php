{{--
|--------------------------------------------------------------------------
| Card Accordion Component
|--------------------------------------------------------------------------
|
| Secções expansíveis e semânticas baseadas em HTML5 nativo (<details>).
| • Totalmente funcional sem dependência de JavaScript.
| • Suporte a título e ícone via props ou slots nomeados.
| • Acessibilidade ARIA e navegação por teclado nativas do browser.
|
--}}

@props([
    'title' => null,
    'icon' => null,
    'open' => false,
    'border' => true,
])

@php
    $titleContent = $title ?? $titleSlot ?? null;
    $iconContent = $icon ?? $iconSlot ?? null;
@endphp

<details
    @if($open) open @endif
    {{ $attributes->class([
        'ui-card-accordion',
        'ui-card-accordion--border' => $border,
    ]) }}
>
    <summary class="ui-card-accordion__header">
        <div class="ui-card-accordion__title">
            {{-- Ícone opcional --}}
            @if($iconContent)
                <span class="ui-card-accordion__icon" aria-hidden="true">
                    {{ $iconContent }}
                </span>
            @endif

            {{-- Título --}}
            @if($titleContent)
                <span class="ui-card-accordion__text">
                    {{ $titleContent }}
                </span>
            @endif
        </div>

        {{-- Indicador Chevron Rotativo --}}
        <span class="ui-card-accordion__indicator" aria-hidden="true">
            <svg
                class="ui-card-accordion__chevron"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd"
                />
            </svg>
        </span>
    </summary>

    {{-- Conteúdo Revelado --}}
    <div class="ui-card-accordion__content">
        {{ $slot }}
    </div>
</details>
