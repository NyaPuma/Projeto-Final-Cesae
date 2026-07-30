{{--
|--------------------------------------------------------------------------
| Floating Action Button (FAB) Component
|--------------------------------------------------------------------------
|
| Botão flutuante para ações principais da aplicação.
| • Totalmente acessível com suporte a leitores de ecrã (aria-label).
| • Flexível com suporte a ícones e textos via props ou slots.
| • Tratamento automático para links e botões desativados.
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'label' => null,
    'variant' => 'primary',
    'size' => 'md',
    'position' => 'bottom-right',
    'extended' => false,
    'fixed' => true,
    'disabled' => false,
])

@php
    $tag = $href ? 'a' : 'button';
    $hasIcon = $icon || isset($iconSlot);

    // Atributos dinâmicos para acessibilidade e comportamento
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        $customAttributes['disabled'] = $disabled;
    } else {
        if ($disabled) {
            $customAttributes['aria-disabled'] = 'true';
            $customAttributes['role'] = 'button';
            $customAttributes['tabindex'] = '-1';
        } else {
            $customAttributes['href'] = $href;
        }
    }

    // Acessibilidade: Quando é apenas ícone, garante aria-label (sem sobresscrever se passado diretamente)
    if (!$extended && $label && !$attributes->has('aria-label')) {
        $customAttributes['aria-label'] = $label;
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-fab',
        "ui-fab--{$variant}",
        "ui-fab--{$size}",
        "ui-fab--{$position}",
        'ui-fab--extended' => $extended,
        'ui-fab--fixed' => $fixed,
        'ui-fab--disabled' => $disabled,
    ]) }}
>
    {{-- Ícone do FAB --}}
    @if($hasIcon)
        <span class="ui-fab__icon" aria-hidden="true">
            {{ $iconSlot ?? (is_string($icon) ? {!! $icon !!} : $icon) }}
        </span>
    @endif

    {{-- Rótulo Visível (Modo Expandido) --}}
    @if($extended)
        @if($label || $slot->isNotEmpty())
            <span class="ui-fab__label">
                {{ $label ?? $slot }}
            </span>
        @endif
    @endif
</{{ $tag }}>
