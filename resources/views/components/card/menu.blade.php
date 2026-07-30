{{--
|--------------------------------------------------------------------------
| Card Menu Component
|--------------------------------------------------------------------------
|
| Menu contextual interativo (dropdown) para ações rápidas do cartão.
| • Requer Alpine.js (standard no Laravel stack).
| • Suporte a fecho via tecla ESC, clique exterior (@click.outside) e seleção de opção.
| • Ícone predefinido vetorial (3 pontos / ellipsis) com fallback inteligente.
| • Acessibilidade WCAG completa (role="menu", aria-expanded, aria-haspopup e aria-label).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'position' => 'right',      // 'right', 'left', 'top-right', 'top-left'
    'trigger' => null,           // Prop de ícone/conteúdo direto do botão trigger
    'label' => 'Opções do cartão', // Rótulo de acessibilidade (aria-label) para o trigger
    'closeOnSelect' => true,     // Fecha automaticamente o menu ao clicar num item interno
])

@php
    // Normalização e validação de alinhamentos e posições
    $normalizedPosition = match(mb_strtolower($position)) {
        'left', 'start' => 'left',
        'top-left', 'top-start' => 'top-left',
        'top-right', 'top-end' => 'top-right',
        'bottom-left' => 'left',
        'bottom-right' => 'right',
        default => 'right',
    };

    $allowedPositions = ['right', 'left', 'top-right', 'top-left'];
    $validPosition = in_array($normalizedPosition, $allowedPositions, true) ? $normalizedPosition : 'right';

    // Resolução flexível do botão trigger (prop, slot nomeado ou nulo)
    $triggerContent = $trigger ?? $triggerSlot ?? null;
@endphp

<div
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    @click.outside="open = false"
    {{ $attributes->class([
        'ui-card-menu',
        "ui-card-menu--pos-{$validPosition}",
    ]) }}
>
    {{-- Botão Trigger do Menu --}}
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        aria-haspopup="true"
        aria-label="{{ $label }}"
        class="ui-card-menu__trigger"
    >
        @if($triggerContent)
            @if(is_string($triggerContent) && str_starts_with(trim($triggerContent), '<svg'))
                {!! $triggerContent !!}
            @else
                {{ $triggerContent }}
            @endif
        @else
            {{-- Ícone padrão de 3 pontos verticais (Ellipsis Vertical SVG) --}}
            <svg class="ui-card-menu__trigger-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="12" cy="5" r="1"></circle>
                <circle cx="12" cy="19" r="1"></circle>
            </svg>
        @endif
    </button>

    {{-- Painel de Conteúdo / Opções do Menu --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        @if($closeOnSelect) @click="open = false" @endif
        role="menu"
        tabindex="-1"
        class="ui-card-menu__content"
    >
        {{ $slot }}
    </div>
</div>
