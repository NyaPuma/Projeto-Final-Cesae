{{--
|--------------------------------------------------------------------------
| Page Header Component
|--------------------------------------------------------------------------
|
| Modular header for sections with eyebrow, prominent title and description.
| • 100% free of inline CSS or JS.
| • Global attribute support and margin customization via $attributes.
| • Robust defensive checks for optional elements.
|
--}}

@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->class(['mb-8']) }}>
    @if($eyebrow)
        <x-ui.text.eyebrow as="p" size="md" tracking="widest">
            {{ $eyebrow }}
        </x-ui.text.eyebrow>
    @endif

    @if($title)
        <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">
            {{ $title }}
        </h2>
    @endif

    @if($description)
        <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">
            {{ $description }}
        </p>
    @endif
</div>
