{{--
|--------------------------------------------------------------------------
| Button Dropdown Component (Otimizado)
|--------------------------------------------------------------------------
|
| Componente de Menu Dropdown integrado e acessível.
| • Suporta Alpine.js nativo para interatividade out-of-the-box.
| • Cumpre as diretrizes ARIA (Acessibilidade).
| • Tratamento dinâmico de IDs para evitar colisões na página.
|
--}}

@props([
    'label' => null,
    'icon' => null,
    'variant' => 'primary',
    'size' => 'md',
    'align' => 'right', // 'right' ou 'left'
    'disabled' => false,
])

@php
    // Gera um identificador único para associar o botão ao menu via ARIA
    $dropdownId = $attributes->get('id') ?? uniqid('ui-dropdown-');
@endphp

<div
    {{ $attributes->except('id')->class([
        'ui-button-dropdown',
        "ui-button-dropdown--{$variant}",
        "ui-button-dropdown--{$size}",
        'ui-button-dropdown--disabled' => $disabled,
    ]) }}
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    {{-- Gatilho (Trigger Button) --}}
    <button
        type="button"
        id="{{ $dropdownId }}-trigger"
        class="ui-button-dropdown__trigger"
        @disabled($disabled)
        aria-haspopup="true"
        :aria-expanded="open ? 'true' : 'false'"
        aria-controls="{{ $dropdownId }}-menu"
        @click="open = !open"
    >
        @if($icon)
            <span class="ui-button-dropdown__icon" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif

        @if($label)
            <span class="ui-button-dropdown__label">
                {{ $label }}
            </span>
        @endif

        {{-- Chevron Otimizado com Rotação Dinâmica --}}
        <svg
            class="ui-button-dropdown__chevron"
            :class="{ 'ui-button-dropdown__chevron--active': open }"
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

    {{-- Menu Dropdown (Conteúdo do Slot) --}}
    <div
        id="{{ $dropdownId }}-menu"
        class="ui-button-dropdown__menu ui-button-dropdown__menu--{{ $align }}"
        role="menu"
        aria-labelledby="{{ $dropdownId }}-trigger"
        x-show="open"
        x-transition:enter="ui-dropdown-transition-enter"
        x-transition:enter-start="ui-dropdown-transition-start"
        x-transition:enter-end="ui-dropdown-transition-end"
        x-transition:leave="ui-dropdown-transition-leave"
        x-transition:leave-start="ui-dropdown-transition-leave-start"
        x-transition:leave-end="ui-dropdown-transition-leave-end"
        style="display: none;"
    >
        <div class="ui-button-dropdown__menu-content" role="none">
            {{ $slot }}
        </div>
    </div>
</div>
