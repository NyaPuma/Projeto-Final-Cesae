{{--
|--------------------------------------------------------------------------
| Componente Button
|--------------------------------------------------------------------------
|
| Componente base acessível e reutilizável para o Design System.
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
    $isDisabled = $disabled || $loading;
    $tag = $href ? 'a' : 'button';

    // Construção centralizada e limpa de atributos dinâmicos
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        $customAttributes['disabled'] = $isDisabled;
    } else {
        if ($isDisabled) {
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

    // Suporte flexível para ícone via Slot nomeado ou Prop
    $hasIcon = $icon || isset($iconSlot);
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-button',
        "ui-button--{$variant}",
        "ui-button--{$size}",
        'ui-button--loading' => $loading,
        'ui-button--disabled' => $isDisabled,
        'ui-button--block' => $fullWidth,
        'ui-button--rounded' => $rounded,
    ]) }}
>
    {{-- Spinner / Loader --}}
    @if($loading)
        <span class="ui-button__spinner" aria-hidden="true"></span>
    @endif

    {{-- Ícone à Esquerda --}}
    @if($hasIcon && $iconPosition === 'left' && !$loading)
        <span class="ui-button__icon" aria-hidden="true">
            {{ $iconSlot ?? (is_string($icon) ? {!! $icon !!} : $icon) }}
        </span>
    @endif

    {{-- Texto do Botão --}}
    @if($slot->isNotEmpty())
        <span class="ui-button__label">
            {{ $slot }}
        </span>
    @endif

    {{-- Ícone à Direita --}}
    @if($hasIcon && $iconPosition === 'right' && !$loading)
        <span class="ui-button__icon" aria-hidden="true">
            {{ $iconSlot ?? (is_string($icon) ? {!! $icon !!} : $icon) }}
        </span>
    @endif
</{{ $tag }}>
