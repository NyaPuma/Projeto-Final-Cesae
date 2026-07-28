@props([
    'title',
    'description',
    'container_id',
])

<article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
    <header class="border-b border-[var(--border)] p-6">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <p class="mt-2 text-sm text-soft">{{ $description }}</p>
    </header>
    <div id="{{ $container_id }}" class="divide-y divide-[var(--border)]"></div>
</article>
