{{--
|--------------------------------------------------------------------------
| Card Empty State Component (Otimizado)
|--------------------------------------------------------------------------
|
| Exibe estados vazios de forma elegante para tabelas, listas ou filtros.
| • Suporte híbrido: usa propriedades de texto simples ou slots ricos.
| • Tamanhos escaláveis ('sm', 'md', 'lg') para qualquer área de card.
| • Controlo de alinhamento semântico ('center' ou 'left').
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'action' => null,
    'size' => 'md',        // 'sm', 'md', 'lg'
    'align' => 'center',    // 'center', 'left'
])

<div
    {{ $attributes->class([
        'ui-card-empty',
        "ui-card-empty--{$size}",
        "ui-card-empty--align-{$align}",
    ]) }}
>
    {{-- Ícone / Ilustração (Prop ou Slot) --}}
    @if($icon || isset($iconSlot))
        <div class="ui-card-empty__icon" aria-hidden="true">
            @if(isset($iconSlot))
                {{ $iconSlot }}
            @else
                {!! $icon !!}
            @endif
        </div>
    @endif

    {{-- Bloco de Textos --}}
    @if($title || isset($titleSlot) || $description || isset($descriptionSlot))
        <div class="ui-card-empty__content">
            @if($title || isset($titleSlot))
                <h3 class="ui-card-empty__title">
                    @if(isset($titleSlot))
                        {{ $titleSlot }}
                    @else
                        {{ $title }}
                    @endif
                </h3>
            @endif

            @if($description || isset($descriptionSlot))
                <p class="ui-card-empty__description">
                    @if(isset($descriptionSlot))
                        {{ $descriptionSlot }}
                    @else
                        {{ $description }}
                    @endif
                </p>
            @endif
        </div>
    @endif

    {{-- Ações Rápidas (Prop ou Slot) --}}
    @if($action || isset($actionSlot))
        <div class="ui-card-empty__action">
            @if(isset($actionSlot))
                {{ $actionSlot }}
            @else
                {!! $action !!}
            @endif
        </div>
    @endif

    {{-- Elementos Extra Customizados --}}
    @if($slot->isNotEmpty())
        <div class="ui-card-empty__extra">
            {{ $slot }}
        </div>
    @endif
</div>
