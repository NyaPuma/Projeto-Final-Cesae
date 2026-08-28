{{--
|-------------------------------------------------------------------------- |
| Form Select Component (Optimized)
|-------------------------------------------------------------------------- |
| Reusable select element integrated with the Design System with support
| for dynamic attributes and slots for options.
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
