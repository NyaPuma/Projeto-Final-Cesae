{{--
|--------------------------------------------------------------------------
| Button Component
|--------------------------------------------------------------------------
|
| Componente base e flexível para o teu Design System.
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'loading' => false,
    'disabled' => false,
    'fullWidth' => false,
    'rounded' => false,
])

@php
    // Determina dinamicamente se o elemento deve ser uma âncora ou um botão
    $tag = $href ? 'a' : 'button';

    // Centralização de Atributos de Acessibilidade e Comportamento
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        if ($disabled || $loading) {
            $customAttributes['disabled'] = true;
        }
    } else {
        // Tratamento robusto para links com comportamento de botão
        if ($disabled) {
            $customAttributes['aria-disabled'] = 'true';
            $customAttributes['role'] = 'button';
            $customAttributes['tabindex'] = '-1';
        } else {
            $customAttributes['href'] = $href;
        }
    }

    if ($loading) {
        $customAttributes['aria-busy'] = 'true';
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-button',
        "ui-button--{$variant}",
        "ui-button--{$size}",
        'ui-button--loading' => $loading,
        'ui-button--disabled' => $disabled,
        'ui-button--block' => $fullWidth,
        'ui-button--rounded' => $rounded,
    ]) }}
>
    {{-- Spinner / Loader --}}
    @if($loading)
        <span class="ui-button__spinner" aria-hidden="true"></span>
    @endif

    {{-- Ícone à Esquerda (Escondido se estiver a carregar para evitar quebras visuais) --}}
    @if($icon && $iconPosition === 'left' && !$loading)
        <span class="ui-button__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif

    {{-- Texto do Botão --}}
    <span class="ui-button__label">
        {{ $slot }}
    </span>

    {{-- Ícone à Direita (Escondido se estiver a carregar) --}}
    @if($icon && $iconPosition === 'right' && !$loading)
        <span class="ui-button__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif
</{{ $tag }}>
