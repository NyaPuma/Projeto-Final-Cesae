{{--
|--------------------------------------------------------------------------
| Card Chip Component (Otimizado)
|--------------------------------------------------------------------------
|
| Pequenos indicadores interativos e etiquetas para categorias, filtros ou estados.
| • Suporta comportamento dinâmico de remoção com Alpine.js e disparo de eventos.
| • Suporte a estados interativos (clickable, active) para sistemas de filtragem.
| • Ícone de remoção acessível com SVG, evitando caracteres de multiplicação (×).
|
--}}

@props([
    'variant' => 'default',   // 'default', 'primary', 'success', 'warning', 'danger', 'info'
    'size' => 'md',           // 'sm', 'md', 'lg'
    'removable' => false,     // Permite remover o chip com um botão de fechar
    'clickable' => false,     // Ativa feedback visual de clique (hover/active pointer)
    'active' => false,        // Indica que o chip está selecionado (útil para filtros)
    'icon' => null,           // Ícone opcional no início do chip
])

<span
    {{ $attributes->class([
        'ui-card-chip',
        "ui-card-chip--{$variant}",
        "ui-card-chip--{$size}",
        'ui-card-chip--clickable' => $clickable || $active,
        'ui-card-chip--active' => $active,
        'ui-card-chip--removable' => $removable,
    ]) }}
    @if($removable)
        x-data="{ visible: true }"
        x-show="visible"
        x-transition:leave="ui-card-chip-transition-leave"
        x-transition:leave-start="ui-card-chip-transition-start"
        x-transition:leave-end="ui-card-chip-transition-end"
    @endif
>
    {{-- Ícone Opcional --}}
    @if($icon)
        <span class="ui-card-chip__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif

    {{-- Texto da Etiqueta --}}
    <span class="ui-card-chip__label">
        {{ $slot }}
    </span>

    {{-- Botão de Remoção Acessível e Reativo --}}
    @if($removable)
        <button
            type="button"
            class="ui-card-chip__remove"
            aria-label="Remover {{ trim($slot) }}"
            @click.stop="visible = false; $dispatch('chip-removed', { value: '{{ trim($slot) }}' })"
        >
            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</span>
