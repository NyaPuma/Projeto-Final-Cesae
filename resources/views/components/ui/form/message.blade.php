@props([
    'id',
])

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'min-h-6 text-sm font-medium text-(--text-soft)']) }}></div>
