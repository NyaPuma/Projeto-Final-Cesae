{{--
|--------------------------------------------------------------------------
| Message / Alert Container Component
|--------------------------------------------------------------------------
|
| Dynamic container for displaying feedback messages and alerts with A11y.
| • 100% free of inline CSS or JS.
| • CSS variable syntax corrected and safe for Tailwind.
| • Idiomatic class management and conditional states via $attributes.
|
--}}

@props([
    'id' => 'msg',
    'hidden' => true,
])

<div
    id="{{ $id }}"
    aria-live="polite"
    {{ $attributes->class([
        'hidden' => $hidden,
        'flex min-h-[48px] items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 text-sm font-medium text-[var(--text-soft)]',
    ]) }}
></div>
