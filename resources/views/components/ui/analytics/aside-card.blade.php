{{--
|--------------------------------------------------------------------------
| Stat Card Component
|--------------------------------------------------------------------------
|
| Modular card for displaying metrics, KPIs or quick statistics.
| • 100% free of inline CSS or JS.
| • Hybrid value support via property or flexible slot.
| • CSS variable syntax corrected for Tailwind.
|
--}}

@props([
    'label' => null,
    'value' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-4 shadow-xs transition-all']) }}>
    @if($label)
        <x-ui.text.eyebrow tracking="tight">
            {{ $label }}
        </x-ui.text.eyebrow>
    @endif

    <div class="mt-2 text-lg font-bold text-[var(--text)]">
        {{ $value ?? $slot }}
    </div>
</div>
