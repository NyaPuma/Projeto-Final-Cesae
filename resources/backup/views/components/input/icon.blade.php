{{--
|--------------------------------------------------------------------------
| Input Icon Component (Otimizado)
|--------------------------------------------------------------------------
|
| Wrapper para ícones dentro de inputs.
| • Acessibilidade: aria-hidden="true".
| • Flexibilidade: Suporta qualquer conteúdo via slot.
|
--}}

@props([
    'position' => 'start', // 'start' ou 'end'
    'variant' => 'default', // 'default', 'success', 'warning', 'error'
    'size' => 'md', // 'sm', 'md', 'lg'
])

<span
    {{ $attributes->class([
        'ui-input-icon',
        "ui-input-icon--{$position}",
        "ui-input-icon--{$variant}",
        "ui-input-icon--{$size}",
    ]) }}
    aria-hidden="true"
>
    {{ $slot }}
</span>
