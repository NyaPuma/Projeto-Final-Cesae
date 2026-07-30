{{--
|--------------------------------------------------------------------------
| Button Dropdown Component
|--------------------------------------------------------------------------
|
| Componente de Menu Dropdown integrado e acessível.
| • Interatividade via Alpine.js sem CSS/JS inline.
| • Cumpre as diretrizes ARIA (Acessibilidade) com gestão de foco.
| • Identificadores únicos para evitar colisões no DOM.
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
    // Identificador único para associação ARIA entre botão e menu
    $dropdownId = $attributes->get('id', 'ui-dropdown-' . \Illuminate\Support\Str::random(6));
    $hasIcon = $icon || isset($iconSlot);
@endphp

<div
    {{ $attributes->except(['id'])->class([
        'ui-button-dropdown',
        "ui-button-dropdown--{$variant}",
        "ui-button-dropdown--{$size}",
        'ui-button-dropdown--disabled' => $disabled,
    ]) }}
    x-data="{
        open: false,
        close(focusTrigger = false) {
            if (!this.open) return;
            this.open = false;
            if (focusTrigger) {
                this.$refs.trigger.focus();
            }
        }
    }"
    @click.outside="close()"
    @keydown.escape.window="close(true)"
>
    {{-- Gatilho (Trigger Button) --}}
    <button
        type="button"
        id="{{ $dropdownId }}-trigger"
        x-ref="trigger"
        class="ui-button-dropdown__trigger"
        @disabled($disabled)
        aria-haspopup="true"
        :aria-expanded="open ? 'true' : 'false'"
        aria-controls="{{ $dropdownId }}-menu"
        @click="open = !open"
    >
        @if($hasIcon)
            <span class="ui-button-dropdown__icon" aria-hidden="true">
                {{ $iconSlot ?? (is_string($icon) ? {!! $icon !!} : $icon) }}
            </span>
        @endif

        @if($label)
            <span class="ui-button-dropdown__label">
                {{ $label }}
            </span>
        @endif

        {{-- Chevron com Rotação Dinâmica por Classe --}}
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

    {{-- Menu Dropdown --}}
    <div
        id="{{ $dropdownId }}-menu"
        class="ui-button-dropdown__menu ui-button-dropdown__menu--{{ $align }}"
        role="menu"
        aria-labelledby="{{ $dropdownId }}-trigger"
        x-show="open"
        x-cloak
        x-transition:enter="ui-dropdown-transition-enter"
        x-transition:enter-start="ui-dropdown-transition-start"
        x-transition:enter-end="ui-dropdown-transition-end"
        x-transition:leave="ui-dropdown-transition-leave"
        x-transition:leave-start="ui-dropdown-transition-leave-start"
        x-transition:leave-end="ui-dropdown-transition-leave-end"
    >
        <div class="ui-button-dropdown__menu-content" role="none">
            {{ $slot }}
        </div>
    </div>
</div>
