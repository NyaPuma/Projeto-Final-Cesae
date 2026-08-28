{{--
|--------------------------------------------------------------------------
| Chart Card Component
|--------------------------------------------------------------------------
|
| Structured card for displaying charts with canvas, header and actions slot.
| • 100% free of inline CSS or JS.
| • Header code duplication eliminated with auxiliary slot ($aside) support.
| • CSS variable syntax corrected and safe for Tailwind.
|
--}}

@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'canvas_id' => null,
    'heightClass' => 'h-[320px]',
])

<article {{ $attributes->class(['overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]']) }}>
    <header class="border-b border-[var(--border)] p-8">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                @if($eyebrow)
                    <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
                @endif

                @if($title)
                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-[var(--text)]">{{ $title }}</h2>
                @endif

                @if($description)
                    <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ $description }}</p>
                @endif
            </div>

            @isset($aside)
                <div class="shrink-0">
                    {{ $aside }}
                </div>
            @endisset
        </div>
    </header>

    <div class="p-8">
        @if($canvas_id)
            <div class="{{ $heightClass }}">
                <canvas id="{{ $canvas_id }}"></canvas>
            </div>
        @endif

        {{ $slot }}
    </div>
</article>
