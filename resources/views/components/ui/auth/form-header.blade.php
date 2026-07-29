@props([
    'eyebrow',
    'title',
    'description',
])

<div class="mb-8">
    <x-ui.text.eyebrow as="p" size="md" tracking="widest">{{ $eyebrow }}</x-ui.text.eyebrow>
    <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">{{ $title }}</h2>
    <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ $description }}</p>
</div>
