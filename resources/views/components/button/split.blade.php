{{--
|--------------------------------------------------------------------------
| Split Button Component
|--------------------------------------------------------------------------
|
| Botão dividido com ação primária e gatilho de menu secundário.
| • Interatividade via Alpine.js sem CSS/JS inline (x-cloak).
| • Gestão de foco ARIA e fecho por teclado (Escape).
| • Suporte a tipo 'submit'/'button' e identificadores únicos no DOM.
|
--}}

@props([
    'label' => null,
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'align' => 'right', // 'right' ou 'left'
    'disabled' => false,
])

@php
    $actionTag = $href ? 'a' : 'button';
    $splitId = $attributes->get('id', 'ui-split-' . \Illuminate\Support\Str::random(6));
    $actionLabel = $label ?? $actionSlot ?? null;
@endphp

<div
    {{ $attributes->except(['id'])->class([
        'ui-split-button',
        "ui-split-button--{$variant}",
        "ui-split-button--{$size}",
        'ui-split-button--disabled' => $disabled,
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
    {{-- Ação Principal (Esquerda) --}}
    <{{ $actionTag }}
        class="ui-split-button__action"
        @if($actionTag === 'button')
            type="{{ $type }}"
            @disabled($disabled)
        @else
            @if($disabled)
                aria-disabled="true"
                role="button"
                tabindex="-1"
            @else
                href="{{ $href }}"
            @endif
        @endif
    >
        {{ $actionLabel }}
    </{{ $actionTag }}>

    {{-- Gatilho de Abertura do Menu (Direita) --}}
    <button
        type="button"
        id="{{ $splitId }}-trigger"
        x-ref="trigger"
        class="ui-split-button__toggle"
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
        x-cloak
        x-transition:enter="ui-dropdown-transition-enter"
        x-transition:enter-start="ui-dropdown-transition-start"
        x-transition:enter-end="ui-dropdown-transition-end"
        x-transition:leave="ui-dropdown-transition-leave"
        x-transition:leave-start="ui-dropdown-transition-leave-start"
        x-transition:leave-end="ui-dropdown-transition-leave-end"
    >
        <div class="ui-split-button__menu-content" role="none">
            {{ $slot }}
        </div>
    </div>
</div>
