{{--
|--------------------------------------------------------------------------
| Card Header Component (Otimizado)
|--------------------------------------------------------------------------
|
| Responsável pela área superior do card: organiza títulos, descrições e ações.
| • Arquitetura híbrida: aceita propriedades simples ou slots estruturados.
| • Alinhamento flexível e distribuição de espaço automática (Flexbox).
| • Gestão moderna de classes CSS através da diretiva @class do Blade.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'spacing' => 'md',      // 'none', 'sm', 'md', 'lg'
    'border' => true,       // Exibe uma linha divisória fina no fundo do cabeçalho
    'align' => 'center',    // 'start', 'center', 'end' (Alinhamento vertical do conteúdo)
])

@php
    $hasActions = isset($actions) && $actions->isNotEmpty();
@endphp

<header
    {{ $attributes->class([
        'ui-card-header',
        "ui-card-header--spacing-{$spacing}",
        "ui-card-header--align-{$align}",
        'ui-card-header--bordered' => $border,
        'ui-card-header--has-actions' => $hasActions,
    ]) }}
>
    {{-- Bloco Principal (Ícone + Textos) --}}
    <div class="ui-card-header__lead">
        {{-- Área do Ícone --}}
        @if($icon || isset($iconSlot))
            <div class="ui-card-header__icon" aria-hidden="true">
                @if(isset($iconSlot))
                    {{ $iconSlot }}
                @else
                    {!! $icon !!}
                @endif
            </div>
        @endif

        {{-- Textos (Título e Descrição) --}}
        @if($title || $description || $slot->isNotEmpty())
            <div class="ui-card-header__content">
                @if($title)
                    <h3 class="ui-card-header__title">
                        {{ $title }}
                    </h3>
                @endif

                @if($description)
                    <p class="ui-card-header__description">
                        {{ $description }}
                    </p>
                @endif

                {{-- Permite renderizar HTML livre se não usares os parâmetros title/description --}}
                @if($slot->isNotEmpty() && !$title && !$description)
                    {{ $slot }}
                @endif
            </div>
        @endif
    </div>

    {{-- Slot de Ações (Alinhado à direita de forma automática) --}}
    @if($hasActions)
        <div class="ui-card-header__actions">
            {{ $actions }}
        </div>
    @endif
</header>
