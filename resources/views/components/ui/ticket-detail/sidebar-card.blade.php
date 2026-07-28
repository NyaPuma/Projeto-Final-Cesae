@props([
    'title',
])

<section {{ $attributes->class(['rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm']) }}>
    <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ $title }}</h3>
    {{ $slot }}
</section>
