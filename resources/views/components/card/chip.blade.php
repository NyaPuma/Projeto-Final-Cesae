{{--
|--------------------------------------------------------------------------
| Card Chip Component
|--------------------------------------------------------------------------
|
| Pequenos indicadores interativos e etiquetas para categorias, filtros ou estados.
| • Suporta passagem de texto por prop 'label' ou slot predefinido.
| • Disparo seguro de eventos Alpine.js usando @js() para evitar quebras de aspas.
| • Prop 'value' dedicada para o evento 'chip-removed' (com fallback para o texto).
| • Acessibilidade ARIA melhorada para chips clicáveis (role="button" e tabindex).
|
--}}

@props([
    'label' => null,          // Texto alternativo ao slot
    'value' => null,          // Valor emitido no evento 'chip-removed'
    'variant' => 'default',   // 'default', 'primary', 'success', 'warning', 'danger'/'error', 'info'
    'size' => 'md',           // 'sm', 'md', 'lg'
    'removable' => false,     // Permite remover o chip com um botão de fechar
    'clickable' => false,     // Ativa feedback visual de clique (hover/active pointer)
    'active' => false,        // Indica que o chip está selecionado (útil para filtros)
    'icon' => null,           // Ícone SVG ou componente opcional
])

@php
    // Normalização de variantes para manter consistência no CSS
    $normalizedVariant = match($variant) {
        'error' => 'danger',
        default => $variant,
    };

    // Resolução de conteúdo do rótulo e do ícone
    $chipLabel = $slot->isNotEmpty() ? $slot : $label;
    $iconContent = $icon ?? $iconSlot ?? null;
    $hasLabel = !empty($chipLabel);

    // Determina o valor textual limpo emitido pelo evento de remoção
    $chipValue = $value ?? trim(strip_tags((string) $chipLabel));

    $isClickable = $clickable || $active;
@endphp

<span
    {{ $attributes->class([
        'ui-card-chip',
        "ui-card-chip--{$normalizedVariant}",
        "ui-card-chip--{$size}",
        'ui-card-chip--clickable' => $isClickable,
        'ui-card-chip--active' => $active,
        'ui-card-chip--removable' => $removable,
    ]) }}
    @if($isClickable && !$removable)
        role="button"
        tabindex="0"
    @endif
    @if($removable)
        x-data="{ visible: true }"
        x-show="visible"
        x-cloak
        x-transition:leave="ui-card-chip-transition-leave"
        x-transition:leave-start="ui-card-chip-transition-start"
        x-transition:leave-end="ui-card-chip-transition-end"
    @endif
>
    {{-- Ícone Opcional --}}
    @if($iconContent)
        <span class="ui-card-chip__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </span>
    @endif

    {{-- Texto da Etiqueta --}}
    @if($hasLabel)
        <span class="ui-card-chip__label">
            {{ $chipLabel }}
        </span>
    @endif

    {{-- Botão de Remoção Acessível e Reativo --}}
    @if($removable)
        <button
            type="button"
            class="ui-card-chip__remove"
            aria-label="Remover {{ $chipValue }}"
            @click.stop="visible = false; $dispatch('chip-removed', { value: @js($chipValue) })"
        >
            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</span>
