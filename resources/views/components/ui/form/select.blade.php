{{--
|-------------------------------------------------------------------------- |
| Form Select Component (Otimizado)
|-------------------------------------------------------------------------- |
| Elemento de seleção reutilizável integrado com o Design System e suporte
| a atributos dinâmicos e slots para as opções.
|--}}
@props([
    'id' => null,
    'name',
    'required' => false,
])

<select
    @if($id) id="{{ $id }}" @endif
    name="{{ $name }}"
    @if($required) required @endif
    {{ $attributes->merge([
        'class' => 'w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15'
    ]) }}
>
    {{ $slot }}
</select>
