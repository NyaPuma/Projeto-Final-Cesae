{{--
|-------------------------------------------------------------------------- |
| Form Textarea Component (Otimizado)
|-------------------------------------------------------------------------- |
| Área de texto reutilizável com suporte a estados de validação (old),
| redimensionamento customizável e integração com o Design System.
|--}}
@props([
    'id' => null,
    'name',
    'rows' => 4,
    'placeholder' => null,
    'required' => false,
    'resize' => 'none',
    'value' => null,
])

<textarea
    @if($id) id="{{ $id }}" @endif
    name="{{ $name }}"
    rows="{{ $rows }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($required) required @endif
    {{ $attributes->merge([
        'class' => 'w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15' . ($resize === 'none' ? ' resize-none' : '')
    ]) }}
>{{ old($name, $slot->isNotEmpty() ? $slot : $value) }}</textarea>
