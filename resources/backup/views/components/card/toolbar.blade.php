{{--
|--------------------------------------------------------------------------
| Card Toolbar Component (Otimizado)
|--------------------------------------------------------------------------
|
| Barra de ferramentas para filtros, pesquisa e ações.
| • Acessibilidade A11y (role="toolbar").
| • Flexibilidade de layout via CSS (wrap).
|
--}}

@props([
    'position' => 'top',   // 'top', 'bottom'
    'spacing' => 'md',     // 'sm', 'md', 'lg'
    'border' => true,
    'align' => 'between',  // 'start', 'end', 'center', 'between'
])

<div
    {{ $attributes->class([
        'ui-card-toolbar',
        "ui-card-toolbar--{$position}",
        "ui-card-toolbar--spacing-{$spacing}",
        "ui-card-toolbar--align-{$align}",
        'ui-card-toolbar--border' => $border,
    ]) }}
    role="toolbar"
>
    {{ $slot }}
</div>
