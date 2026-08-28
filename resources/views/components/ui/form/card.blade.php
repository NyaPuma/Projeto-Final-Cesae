{{--
|--------------------------------------------------------------------------
| UI Card Wrapper Component
|--------------------------------------------------------------------------
|
| Base component for cards or generic containers with rounded corners and shadows.
| • Optional header with title, description and icon for quick section identification.
| • 'danger' tone for danger zones with subtle alert highlighting.
| • 100% free of inline CSS or JS.
| • CSS variable syntax corrected and safe for Tailwind.
| • Dynamic global attribute forwarding via $attributes.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'iconVariant' => 'primary',
    'tone' => 'default',
])

@php
    $toneClasses = [
        'default' => 'border-[var(--border)] bg-[var(--surface)]',
        'danger' => 'border-danger/20 bg-danger/5',
    ][$tone] ?? 'border-[var(--border)] bg-[var(--surface)]';
@endphp

<div {{ $attributes->merge(['class' => 'rounded-3xl border p-6 shadow-sm ' . $toneClasses]) }}>
    @if($title || $icon)
        <div class="mb-6 flex items-start gap-4">
            @if($icon)
                <span
                    @class([
                        'flex h-10 w-10 shrink-0 items-center justify-center rounded-xl',
                        'bg-primary/10 text-primary' => $iconVariant === 'primary',
                        'bg-danger/10 text-danger' => $iconVariant === 'danger',
                    ])
                    aria-hidden="true"
                >
                    @if(is_string($icon) && str_starts_with(trim($icon), '<svg'))
                        {!! $icon !!}
                    @else
                        {{ $icon }}
                    @endif
                </span>
            @endif

            <div>
                @if($title)
                    <h2 class="text-lg font-semibold text-[var(--text)]">{{ $title }}</h2>
                @endif

                @if($description)
                    <p class="mt-1 text-sm text-[var(--text-soft)]">{{ $description }}</p>
                @endif
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
