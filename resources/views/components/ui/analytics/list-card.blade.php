{{--
|--------------------------------------------------------------------------
| Container Card Component
|--------------------------------------------------------------------------
|
| Structured card with header and dynamic body (ideal for AJAX listings).
| • 100% free of inline CSS or JS.
| • CSS variable syntax corrected and safe for Tailwind.
| • Optional ID support and static content via slot.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'containerId' => null,
])

<article {{ $attributes->class(['overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]']) }}>
    @if($title || $description)
        <header class="border-b border-[var(--border)] p-6">
            @if($title)
                <h3 class="text-lg font-bold text-[var(--text)]">{{ $title }}</h3>
            @endif

            @if($description)
                <p class="mt-2 text-sm text-[var(--text-soft)]">{{ $description }}</p>
            @endif
        </header>
    @endif

    <div
        @if($containerId) id="{{ $containerId }}" @endif
        class="divide-y divide-[var(--border)]"
    >
        {{ $slot }}
    </div>
</article>
