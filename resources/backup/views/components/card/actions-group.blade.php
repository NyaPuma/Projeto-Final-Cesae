{{--
|--------------------------------------------------------------------------
| Card Actions Group Component (Otimizado)
|--------------------------------------------------------------------------
|
| Agrupa múltiplas ações dentro de um card, controlando o layout de forma fluida.
| • Suporta alteração dinâmica de tag (ex: 'footer') para semântica avançada.
| • Controlo de quebra de linha (wrap) integrado para responsividade móvel.
| • Sintaxe moderna do Laravel Blade para gestão de atributos.
|
--}}

@props([
    'direction' => 'horizontal', // 'horizontal' ou 'vertical'
    'align' => 'end',            // 'start', 'center', 'end', 'between', 'stretch'
    'spacing' => 'sm',           // 'none', 'xs', 'sm', 'md', 'lg'
    'wrap' => true,              // Se ativado, permite que os botões quebrem linha em ecrãs móveis
    'tag' => 'div',              // Permite mudar para 'footer' ou 'header' de acordo com a semântica
])

<{{ $tag }}
    {{ $attributes->class([
        'ui-card-actions-group',
        "ui-card-actions-group--{$direction}",
        "ui-card-actions-group--align-{$align}",
        "ui-card-actions-group--spacing-{$spacing}",
        'ui-card-actions-group--wrap' => $wrap,
        'ui-card-actions-group--nowrap' => !$wrap,
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
