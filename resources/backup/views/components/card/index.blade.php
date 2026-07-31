{{--
|--------------------------------------------------------------------------
| Card Index Component (Alias/Wrapper)
|--------------------------------------------------------------------------
|
| Ponto de entrada conveniente para o sistema de cards.
| Reduz a complexidade da chamada, mantendo a flexibilidade total.
|
--}}

@props([
    'variant' => 'default',
    'size' => 'md',
    'hover' => false,
    'clickable' => false,
    'disabled' => false,
    'selected' => false,
    'active' => false,
    'loading' => false,
    'skeleton' => false,
    'compact' => false,
    'flush' => false,
    'role' => null,
])

{{--
    Usamos o componente base.
    Ao declarar os props acima, eles são removidos da bag $attributes.
    Para passá-los para o componente filho, passamos os props explicitamente
    e fundimos o restante com $attributes para permitir flexibilidade (ex: classes customizadas).
--}}

<x-ui.card.card
    :variant="$variant"
    :size="$size"
    :hover="$hover"
    :clickable="$clickable"
    :disabled="$disabled"
    :selected="$selected"
    :active="$active"
    :loading="$loading"
    :skeleton="$skeleton"
    :compact="$compact"
    :flush="$flush"
    :role="$role"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.card.card>
