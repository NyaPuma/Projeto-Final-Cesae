{{--
|--------------------------------------------------------------------------
| Icon Button Component
|--------------------------------------------------------------------------
|
| Botão composto exclusivamente por um ícone visual.
| • Força acessibilidade (A11y) via tooltip/aria-label e texto sr-only.
| • Suporte flexível para ícones por prop, slot dedicado ou slot padrão.
| • Tags HTML dinâmicas com tratamento seguro de estados desativados.
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'variant' => 'ghost',
    'size' => 'md',
    'loading' => false,
    'disabled' => false,
    'rounded' => true,
    'tooltip' => null,
    'label' => null, // Rótulo alternativo de acessibilidade (caso não uses tooltip)
])

@php
    $isDisabled = $disabled || $loading;
    $tag = $href ? 'a' : 'button';

    // Rótulo de acessibilidade: prioridade para tooltip, depois label e por fim aria-label do atributo
    $accessibleLabel = $tooltip ?? $label ?? $attributes->get('aria-label');

    // Configuração de segurança e acessibilidade conforme a tag utilizada
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

    // Atribuição automática de rótulo e title sem sobrescrever se já definidos
    if ($accessibleLabel && ! $attributes->has('aria-label')) {
        $customAttributes['aria-label'] = $accessibleLabel;
    }

    if ($tooltip && ! $attributes->has('title')) {
        $customAttributes['title'] = $tooltip;
    }

    $hasIcon = $icon || isset($iconSlot) || $slot->isNotEmpty();
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-icon-button',
        "ui-icon-button--{$variant}",
        "ui-icon-button--{$size}",
        'ui-icon-button--rounded' => $rounded,
        'ui-icon-button--loading' => $loading,
        'ui-icon-button--disabled' => $isDisabled,
    ]) }}
>
    @if($loading)
        {{-- Spinner visual do Design System --}}
        <span class="ui-icon-button__spinner" aria-hidden="true"></span>

        {{-- Rótulo dinâmico para leitores de ecrã --}}
        <span class="sr-only">
            {{ $accessibleLabel ? "A carregar {$accessibleLabel}..." : 'A carregar...' }}
        </span>
    @elseif($hasIcon)
        {{-- Ícone (suporta prop, slot nomeado $iconSlot ou slot padrão $slot) --}}
        <span class="ui-icon-button__icon" aria-hidden="true">
            {{ $iconSlot ?? (is_string($icon) ? {!! $icon !!} : ($icon ?? $slot)) }}
        </span>
    @endif
</{{ $tag }}>
