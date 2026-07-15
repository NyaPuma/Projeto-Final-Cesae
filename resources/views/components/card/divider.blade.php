{{--
|--------------------------------------------------------------------------
| Card Divider Component (Otimizado)
|--------------------------------------------------------------------------
|
| Separador visual dentro do card para organizar grupos de informação.
| • Suporte nativo para orientações horizontais e verticais.
| • Inclusão automática de rótulo textual centralizado se o slot for usado.
| • Propriedade 'dashed' para divisões secundárias discretas.
| • Atributos ARIA dinâmicos para acessibilidade total de leitura.
|
--}}

@props([
    'spacing' => 'md',             // 'none', 'xs', 'sm', 'md', 'lg'
    'orientation' => 'horizontal', // 'horizontal', 'vertical'
    'dashed' => false,             // Linha tracejada em vez de sólida
])

@php
    $hasSlot = $slot->isNotEmpty();
    $isHorizontal = $orientation === 'horizontal';
@endphp

<div
    {{ $attributes->class([
        'ui-card-divider',
        "ui-card-divider--{$orientation}",
        "ui-card-divider--spacing-{$spacing}",
        'ui-card-divider--dashed' => $dashed,
        'ui-card-divider--with-label' => $hasSlot && $isHorizontal,
    ])->merge([
        'role' => 'separator',
        'aria-orientation' => $orientation,
    ]) }}
>
    {{-- Renderiza o texto central apenas se for horizontal e contiver conteúdo --}}
    @if($hasSlot && $isHorizontal)
        <span class="ui-card-divider__label">
            {{ $slot }}
        </span>
    @endif
</div>
