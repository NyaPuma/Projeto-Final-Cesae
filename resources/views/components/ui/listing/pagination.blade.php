{{--
|-------------------------------------------------------------------------- |
| Pagination Container Component (Otimizado)
|-------------------------------------------------------------------------- |
| Contentor semântico para a paginação (dinâmica via JS ou Blade) com suporte
| a variáveis do Design System e encaminhamento flexível de atributos.
|--}}
@props([
    'id' => 'pagination',
])

<div {{ $attributes->merge([
    'id' => $id,
    'class' => 'ui-listing-pagination mt-5 flex items-center justify-between px-1 text-xs text-[var(--text-soft)]'
]) }}>
    {{ $slot }}
</div>
