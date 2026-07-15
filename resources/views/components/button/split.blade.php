{{--
|--------------------------------------------------------------------------
| Split Button Component (Otimizado)
|--------------------------------------------------------------------------
|
| Botão dividido com ação primária e gatilho de menu secundário.
| • Integração nativa com Alpine.js para abertura e fecho de menu.
| • Tag dinâmica para evitar duplicação desnecessária de HTML.
| • Cumpre rigorosamente os padrões de acessibilidade ARIA.
|
--}}

@props([
    'label' => null,
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'align' => 'right', // 'right' ou 'left' para alinhar o menu
    'disabled' => false,
])

@php
    // Define a tag do botão de ação principal
    $actionTag = $href ? 'a' : 'button';

    // ID único para controle ARIA entre o toggle e o menu
    $splitId = $attributes->get('id') ?? uniqid('ui-split-');

    // Configuração de atributos para a ação primária
    $actionAttributes = [];
    if ($actionTag === 'button') {
        $actionAttributes['type'] = 'button';
        if ($disabled) {
            $actionAttributes['disabled'] = true;
        }
    } else {
        if ($disabled) {
            $actionAttributes['aria-disabled'] = 'true';
            $actionAttributes['role'] = 'button';
            $actionAttributes['tabindex'] = '-1';
        } else {
            $actionAttributes['href'] = $href;
        }
    }
@endphp

<div
    {{ $attributes->except('id')->class([
        'ui-split-button',
        "ui-split-button--{$variant}",
        "ui-split-button--{$size}",
        'ui-split-button--disabled' => $disabled,
    ]) }}
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    {{-- Ação Principal (Esquerda) --}}
    <{{ $actionTag }}
        {{ new \Illuminate\View\ComponentAttributeBag($actionAttributes) }}
        class="ui-split-button__action"
    >
        {{ $label }}
    </{{ $actionTag }}>

    {{-- Gatilho de Abertura do Menu (Direita) --}}
    <button
        type="button"
        class="ui-split-button__toggle"
        id="{{ $splitId }}-trigger"
        @disabled($disabled)
        aria-haspopup="true"
        :aria-expanded="open ? 'true' : 'false'"
        aria-controls="{{ $splitId }}-menu"
        aria-label="Opções adicionais"
        @click="open = !open"
    >
        <svg
            class="ui-split-button__chevron"
            :class="{ 'ui-split-button__chevron--active': open }"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
        >
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                clip-rule="evenodd"/>
        </svg>
    </button>

    {{-- Menu Secundário Suspenso --}}
    <div
        id="{{ $splitId }}-menu"
        class="ui-split-button__menu ui-split-button__menu--{{ $align }}"
        role="menu"
        aria-labelledby="{{ $splitId }}-trigger"
        x-show="open"
        x-transition:enter="ui-dropdown-transition-enter"
        x-transition:enter-start="ui-dropdown-transition-start"
        x-transition:enter-end="ui-dropdown-transition-end"
        x-transition:leave="ui-dropdown-transition-leave"
        x-transition:leave-start="ui-dropdown-transition-leave-start"
        x-transition:leave-end="ui-dropdown-transition-leave-end"
        style="display: none;"
    >
        <div class="ui-split-button__menu-content" role="none">
            {{ $slot }}
        </div>
    </div>
</div>
