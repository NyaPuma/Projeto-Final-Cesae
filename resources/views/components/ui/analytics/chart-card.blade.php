@props([
    'eyebrow',
    'title',
    'description',
    'canvas_id',
    'height_class' => 'h-[320px]',
    'aside' => null,
])

<article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
    <header class="border-b border-[var(--border)] p-8">
        @if($aside)
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ $eyebrow }}</span>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
                    <p class="mt-3 text-sm leading-7 text-soft">{{ $description }}</p>
                </div>
                {!! $aside !!}
            </div>
        @else
            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ $eyebrow }}</span>
            <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
            <p class="mt-3 text-sm leading-7 text-soft">{{ $description }}</p>
        @endif
    </header>
    <div class="p-8">
        <div class="{{ $height_class }}"><canvas id="{{ $canvas_id }}"></canvas></div>
        {{ $slot }}
    </div>
</article>
