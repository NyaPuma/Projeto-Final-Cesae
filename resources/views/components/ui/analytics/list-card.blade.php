@props([
    'title',
    'description',
    'container_id',
])

<article class="overflow-hidden rounded-3xl border border-(--border) bg-(--surface)">
    <header class="border-b border-(--border) p-6">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <p class="mt-2 text-sm text-soft">{{ $description }}</p>
    </header>
    <div id="{{ $container_id }}" class="divide-y divide-(--border)"></div>
</article>
