{{--
|--------------------------------------------------------------------------
| Section Header Component
|--------------------------------------------------------------------------
|
| Reusable section header with eyebrow, title, optional description and aside slot.
| • 100% free of inline CSS or JS.
| • CSS variable syntax corrected and safe for Tailwind.
| • Optimized responsive layout (stack on mobile, row on desktop).
| • Global attribute support via $attributes.
|
--}}

@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->class(['mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between']) }}>
    <div class="flex-1 min-w-0">
        @if($eyebrow)
            <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
        @endif

        @if($title)
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-[var(--text)]">{{ $title }}</h2>
        @endif

        @if($description)
            <p class="mt-3 max-w-3xl text-sm leading-7 text-[var(--text-soft)]">{{ $description }}</p>
        @endif
    </div>

    @isset($aside)
        <div class="shrink-0">
            {{ $aside }}
        </div>
    @endisset
</div>
