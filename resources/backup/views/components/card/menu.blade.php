{{--
|--------------------------------------------------------------------------
| Card Menu Component (Otimizado)
|--------------------------------------------------------------------------
|
| Menu contextual interativo para ações do card.
| • Requer Alpine.js (standard no Laravel stack).
| • Gestão automática de estado (abrir/fechar/click-away).
| • Acessibilidade A11y (ARIA labels).
|
--}}

@props([
    'position' => 'right', // 'right', 'left'
    'trigger' => null,     // Pode passar o ícone/botão por prop ou slot
])

<div
    x-data="{ open: false }"
    @click.away="open = false"
    {{ $attributes->class([
        'ui-card-menu',
        "ui-card-menu--pos-{$position}",
    ]) }}
>
    {{-- Trigger do Menu --}}
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        aria-haspopup="true"
        class="ui-card-menu__trigger"
    >
        @if($trigger)
            {!! $trigger !!}
        @else
            {{ $triggerSlot ?? '...' }}
        @endif
    </button>

    {{-- Conteúdo do Menu --}}
    <div
        x-show="open"
        x-cloak
        class="ui-card-menu__content"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        {{ $slot }}
    </div>
</div>
