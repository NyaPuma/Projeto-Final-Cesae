{{--
|--------------------------------------------------------------------------
| Icon Button Component (Otimizado)
|--------------------------------------------------------------------------
|
| Botão composto exclusivamente por um ícone visual.
| • Força acessibilidade (A11y) nativa através do uso de tooltips e aria-labels.
| • Garante semântica correta usando tags dinâmicas e atributos ARIA.
| • Código limpo e compatível com as ferramentas de formatação do teu IDE.
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
    'tooltip' => null, // Crucial para acessibilidade
])

@php
    // Determina dinamicamente se o elemento final será um link ou um botão nativo
    $tag = $href ? 'a' : 'button';

    // Configuração de segurança e acessibilidade conforme a tag utilizada
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        if ($disabled || $loading) {
            $customAttributes['disabled'] = true;
        }
    } else {
        // Tratamento seguro para links com comportamento desativado
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

    // Acessibilidade Crítica: O tooltip vira o rótulo descritivo do botão
    if ($tooltip) {
        $customAttributes['aria-label'] = $tooltip;
        $customAttributes['title'] = $tooltip;
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-icon-button',
        "ui-icon-button--{$variant}",
        "ui-icon-button--{$size}",
        'ui-icon-button--rounded' => $rounded,
        'ui-icon-button--loading' => $loading,
        'ui-icon-button--disabled' => $disabled,
    ]) }}
>
    @if($loading)
        {{-- Spinner visual do Design System --}}
        <span class="ui-icon-button__spinner" aria-hidden="true"></span>

        {{-- Texto oculto apenas para leitores de ecrã (Acessibilidade) --}}
        <span class="sr-only">A carregar...</span>
    @else
        {{-- Ícone do botão --}}
        <span class="ui-icon-button__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif
</{{ $tag }}>
