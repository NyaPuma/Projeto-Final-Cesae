{{--
|--------------------------------------------------------------------------
| Input Group Component (Otimizado)
|--------------------------------------------------------------------------
|
| Content wrapper para agrupar inputs, botões e addons.
| • role="group" para acessibilidade A11y.
| • Flexbox ready para alinhamento.
|
--}}

@props([
    'position' => 'default',
    'size' => 'md',
    'attached' => true,
])

<div {{ $attributes->class([
    'ui-input-group',
    'ui-input-group--attached' => $attached,
    "ui-input-group--{$size}",
    "ui-input-group--{$position}",
]) }} role="group">
    {{ $slot }}
</div>
