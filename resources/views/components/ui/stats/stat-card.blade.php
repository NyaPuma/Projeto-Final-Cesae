{{--
|--------------------------------------------------------------------------
| Stat Card Component
|--------------------------------------------------------------------------
| Compact statistical card (label, value, sublabel and optional icon).
| Shared by entity detail pages so the KPI grid never diverges.
| • Tone: 'warning' or 'info' colours the value; any other value keeps the text colour.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'label' => null,
    'icon' => null,
    'iconClass' => 'text-[var(--text-soft)]',
    'sublabel' => null,
    'tone' => null,
])

@php
    $valueClass = match ($tone) {
        'warning' => 'text-warning',
        'info' => 'text-info',
        'danger' => 'text-danger',
        'success' => 'text-success',
        default => 'text-[var(--text)]',
    };
@endphp

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm']) }}>
    <div class="flex items-center justify-between @if(!$label && !$icon) hidden @endif">
        @if($label)
            <p class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $label }}</p>
        @endif

        @if($icon)
            <span class="{{ $iconClass }}" aria-hidden="true">{!! $icon !!}</span>
        @endif
    </div>

    <p class="mt-2 text-2xl font-black {{ $valueClass }}">{{ $slot }}</p>

    @if($sublabel)
        <p class="mt-0.5 text-xs font-medium text-[var(--text-soft)]">{{ $sublabel }}</p>
    @endif
</div>