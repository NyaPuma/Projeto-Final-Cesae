{{--
|-------------------------------------------------------------------------- |
| Pagination Container Component (Optimized)
|-------------------------------------------------------------------------- |
| Semantic container for pagination (dynamic via JS or Blade) with Design
| System variable support and flexible attribute forwarding.
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
