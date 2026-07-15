{{--
|--------------------------------------------------------------------------
| Card List Item Component (Otimizado)
|--------------------------------------------------------------------------
|
| Item de linha para listas dentro de cards.
| • Suporta props para casos simples e slots nomeados para casos ricos.
| • Acessibilidade garantida (A11y) para estados clicáveis.
|
--}}

@props([
    'icon' => null,
    'title' => null,
    'description' => null,
    'meta' => null,
    'action' => null,
    'clickable' => false,
])

<li
    {{ $attributes->class([
        'ui-card-list-item',
        'ui-card-list-item--clickable' => $clickable,
    ])->merge([
        'role' => $clickable ? 'button' : 'listitem',
        'tabindex' => $clickable ? '0' : null,
    ]) }}
>
    {{-- Ícone --}}
    @if($icon || isset($iconSlot))
        <div class="ui-card-list-item__icon" aria-hidden="true">
            {{ $iconSlot ?? $icon }}
        </div>
    @endif

    {{-- Conteúdo (Título + Descrição) --}}
    <div class="ui-card-list-item__content">
        @if($title || isset($titleSlot))
            <div class="ui-card-list-item__title">
                {{ $titleSlot ?? $title }}
            </div>
        @endif

        @if($description || isset($descriptionSlot))
            <div class="ui-card-list-item__description">
                {{ $descriptionSlot ?? $description }}
            </div>
        @endif
    </div>

    {{-- Meta Informação (Data, Status, etc) --}}
    @if($meta || isset($metaSlot))
        <div class="ui-card-list-item__meta">
            {{ $metaSlot ?? $meta }}
        </div>
    @endif

    {{-- Ações (Botões, Menus) --}}
    @if($action || isset($actionSlot))
        <div class="ui-card-list-item__action">
            {{ $actionSlot ?? $action }}
        </div>
    @endif
</li>
