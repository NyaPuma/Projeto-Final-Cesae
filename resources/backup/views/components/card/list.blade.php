{{--
|--------------------------------------------------------------------------
| Card List Component (Otimizado)
|--------------------------------------------------------------------------
|
| Contentor de listas para dados, tickets, atividades, etc.
| • Gestão automática de estado vazio.
| • Estilos de lista resetados para controlo total de design.
| • Suporte a scrollbar nativo com estilo premium.
|
--}}

@props([
    'spacing' => 'none',      // 'none', 'sm', 'md'
    'dividers' => false,      // Adiciona borda entre itens
    'scrollable' => false,    // Permite scroll vertical
    'emptyMessage' => 'Sem registos disponíveis.',
])

<ul
    {{ $attributes->class([
        'ui-card-list',
        "ui-card-list--spacing-{$spacing}",
        'ui-card-list--dividers' => $dividers,
        'ui-card-list--scrollable' => $scrollable,
    ]) }}
>
    @forelse ($slot as $item)
        {{ $item }}
    @empty
        <li class="ui-card-list__empty">
            {{ $emptyMessage }}
        </li>
    @endforelse
</ul>
