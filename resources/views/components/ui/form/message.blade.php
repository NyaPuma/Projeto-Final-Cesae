{{--
|-------------------------------------------------------------------------- |
| Helper / Description Text Component (Optimized)
|-------------------------------------------------------------------------- |
| Semantic container for help text, descriptions or error messages
| with Design System variable support and dynamic attributes.
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
