{{--
|--------------------------------------------------------------------------
| Button Group Component (Otimizado)
|--------------------------------------------------------------------------
|
| Agrupa vários botões numa única unidade visual e semântica.
| • Cumpre as normas ARIA com role="group" e aria-label opcional.
| • Tag HTML customizável para maior semântica.
| • Sintaxe moderna do Laravel para junção de classes CSS.
|
--}}

@props([
    'direction' => 'horizontal', // 'horizontal' ou 'vertical'
    'attached' => true,          // Une os botões removendo margens e arredondando apenas os cantos externos
    'size' => 'md',              // 'sm', 'md', 'lg' (controlado via cascata CSS)
    'fullWidth' => false,        // Ocupa 100% da largura do container
    'label' => null,             // Nome acessível para leitores de ecrã
    'tag' => 'div',              // Permite alterar a tag wrapper (ex: 'nav', 'div')
])

<{{ $tag }}
    role="group"
    @if($label) aria-label="{{ $label }}" @endif
    {{ $attributes->class([
        'ui-button-group',
        "ui-button-group--{$direction}",
        "ui-button-group--{$size}",
        'ui-button-group--attached' => $attached,
        'ui-button-group--block' => $fullWidth,
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
