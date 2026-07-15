{{--
|--------------------------------------------------------------------------
| Card Footer Component (Otimizado)
|--------------------------------------------------------------------------
|
| Área inferior do card para ações, paginação ou metadados de estado.
| • Layout adaptável: se o slot 'secondary' for usado, ativa modo "split".
| • Suporte a alinhamentos flexíveis ('start', 'center', 'end', 'between').
| • Gestão nativa de classes CSS com a diretiva `@class` do Blade.
|
--}}

@props([
    'spacing' => 'md',      // 'none', 'sm', 'md', 'lg'
    'border' => true,       // Exibe uma linha divisória fina no topo do rodapé
    'align' => 'end',       // 'start', 'center', 'end', 'between' (Alinhamento das ações)
])

@php
    $hasSecondary = isset($secondary) && $secondary->isNotEmpty();

    // Se houver conteúdo secundário/meta, forçamos o alinhamento a ser distribuído ("between")
    // para empurrar as ações para a direita e os metadados para a esquerda.
    $resolvedAlign = $hasSecondary ? 'between' : $align;
@endphp

<footer
    {{ $attributes->class([
        'ui-card-footer',
        "ui-card-footer--spacing-{$spacing}",
        "ui-card-footer--align-{$resolvedAlign}",
        'ui-card-footer--bordered' => $border,
        'ui-card-footer--has-secondary' => $hasSecondary,
    ]) }}
>
    {{-- Conteúdo Secundário (Metadados, Paginação, Descrições à esquerda) --}}
    @if($hasSecondary)
        <div class="ui-card-footer__secondary">
            {{ $secondary }}
        </div>
    @endif

    {{-- Ações Principais (Botões à direita/centro) --}}
    <div class="ui-card-footer__actions">
        {{ $slot }}
    </div>
</footer>
