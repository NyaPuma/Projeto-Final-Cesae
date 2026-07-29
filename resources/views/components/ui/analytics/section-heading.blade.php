@props([
    'eyebrow',
    'title',
    'description' => null,
])

<div class="mb-8 flex items-end justify-between gap-4">
    <div>
        <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ $title }}</h2>
        @if($description)
            <p class="mt-3 max-w-3xl text-sm leading-7 text-soft">{{ $description }}</p>
        @endif
    </div>

    @isset($aside)
        <div class="hidden lg:block">
            {{ $aside }}
        </div>
    @endisset
</div>
