{{--
|--------------------------------------------------------------------------
| Input Addon Component (Otimizado)
|--------------------------------------------------------------------------
|
| Elemento auxiliar para Input Groups (Prefixos/Sufixos).
| • Semântica correta (span).
| • Acessibilidade garantida (aria-hidden).
|
--}}

@props([
    'variant' => 'default', // 'default', 'primary', 'muted'
    'size' => 'md',         // 'sm', 'md', 'lg'
    'position' => 'start',  // 'start', 'end'
])

<span
    {{ $attributes->class([
        'ui-input-addon',
        "ui-input-addon--{$variant}",
        "ui-input-addon--{$size}",
        "ui-input-addon--{$position}",
    ]) }}
    aria-hidden="true"
>
    {{ $slot }}
</span>
