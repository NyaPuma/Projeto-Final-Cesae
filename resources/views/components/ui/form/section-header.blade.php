@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <h2 class="text-sm font-bold text-(--text)">{{ $title }}</h2>
    @if($description)
        <p class="mt-0.5 text-xs text-(--text-soft)">{{ $description }}</p>
    @endif
</div>
