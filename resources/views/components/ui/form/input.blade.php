{{--
|-------------------------------------------------------------------------- |
| Form Input Component (Optimized)
|-------------------------------------------------------------------------- |
| Reusable text field with validation state support (old),
| accessibility and Design System CSS variables.
|--}}
@props([
    'id' => null,
    'name',
    'type' => 'text',
    'autocomplete' => null,
    'placeholder' => null,
    'required' => false,
    'value' => null,
])

@php
    $fieldId = $id ?? str_replace(['.', '[', ']'], ['-', '', ''], $name);
@endphp

<input
    id="{{ $fieldId }}"
    name="{{ $name }}"
    type="{{ $type }}"
    @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($required) required @endif
    value="{{ old($name, $value) }}"
    {{ $attributes->merge([
        'class' => 'w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15'
    ]) }}
>
