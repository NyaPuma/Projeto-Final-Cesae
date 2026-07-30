{{--
|--------------------------------------------------------------------------
| Card Action Component
|--------------------------------------------------------------------------
|
| Botão de ação reutilizável para cards de conteúdo.
| • Alterna entre <a> e <button> consoante o estado e a presença de 'href'.
| • Spinner de carregamento 100% livre de CSS inline.
| • Suporte a ícone via prop ou slot nomeado em segurança.
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'default',
    'size' => 'md',
    'icon' => null,
    'disabled' => false,
    'loading' => false,
])

@php
    $tag = ($href && !$disabled) ? 'a' : 'button';
    $iconContent = $icon ?? $iconSlot ?? null;
@endphp

<{{ $tag }}
    @if($tag === 'button')
        type="{{ $type }}"
        @disabled($disabled || $loading)
    @else
        href="{{ $href }}"
    @endif
    @if($loading)
        aria-busy="true"
    @endif
    {{ $attributes->class([
        'ui-card-action',
        "ui-card-action--{$variant}",
        "ui-card-action--{$size}",
        'ui-card-action--disabled' => $disabled,
        'ui-card-action--loading' => $loading,
    ]) }}
>
    {{-- Spinner de Carregamento --}}
    @if($loading)
        <span class="ui-card-action__loader" aria-hidden="true">
            <svg class="ui-card-action__spinner" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="ui-card-action__spinner-bg" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="ui-card-action__spinner-path" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
        <span class="sr-only">A processar...</span>
    @endif

    {{-- Ícone da Ação --}}
    @if($iconContent && !$loading)
        <span class="ui-card-action__icon" aria-hidden="true">
            {{ $iconContent }}
        </span>
    @endif

    {{-- Conteúdo/Rótulo --}}
    @if($slot->isNotEmpty())
        <span class="ui-card-action__label">
            {{ $slot }}
        </span>
    @endif
</{{ $tag }}>
