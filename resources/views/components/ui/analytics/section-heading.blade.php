@props([
    'eyebrow',
    'title',
    'description' => null,
    'aside' => null,
])

<div class="mb-8 flex items-end justify-between gap-4">
    <div>
        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">{{ $eyebrow }}</span>
        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
        @if($description)
            <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">{{ $description }}</p>
        @endif
    </div>

    @if($aside)
        <div class="hidden lg:block">
            {!! $aside !!}
        </div>
    @endif
</div>
