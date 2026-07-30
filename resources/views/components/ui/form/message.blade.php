{{--
|-------------------------------------------------------------------------- |
| Helper / Description Text Component (Otimizado)
|-------------------------------------------------------------------------- |
| Contentor semântico para textos de ajuda, descrições ou mensagens de erro
| com suporte a variáveis do Design System e atributos dinâmicos.
|--}}
@props([
    'id' => null,
])

<div {{ $attributes->merge(array_filter([
    'id' => $id,
    'class' => 'min-h-6 text-sm font-medium text-[var(--text-soft)]',
])) }}>
    {{ $slot }}
</div>
