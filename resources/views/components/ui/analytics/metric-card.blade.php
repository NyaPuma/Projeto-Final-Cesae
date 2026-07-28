@props([
    'eyebrow',
    'value_id',
    'default_value' => '--',
    'description',
    'icon_bg_class',
    'icon_color_class',
    'icon',
])

<article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ $eyebrow }}</p>
            <h3 id="{{ $value_id }}" class="mt-4 text-4xl font-black">{{ $default_value }}</h3>
        </div>
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl {{ $icon_bg_class }}">
            {!! $icon !!}
        </div>
    </div>
    <p class="mt-6 text-sm text-soft">{{ $description }}</p>
</article>
