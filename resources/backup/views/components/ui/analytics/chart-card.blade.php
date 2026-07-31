@props([
    'eyebrow',
    'title',
    'description',
    'canvas_id',
    'height_class' => 'h-[320px]',
])

<article class="overflow-hidden rounded-3xl border border-(--border) bg-(--surface)">
    <header class="border-b border-(--border) p-8">
        @isset($aside)
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
                    <p class="mt-3 text-sm leading-7 text-soft">{{ $description }}</p>
                </div>
                {{ $aside }}
            </div>
        @else
            <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
            <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
            <p class="mt-3 text-sm leading-7 text-soft">{{ $description }}</p>
        @endisset
    </header>
    <div class="p-8">
        <div class="{{ $height_class }}"><canvas id="{{ $canvas_id }}"></canvas></div>
        {{ $slot }}
    </div>
</article>
