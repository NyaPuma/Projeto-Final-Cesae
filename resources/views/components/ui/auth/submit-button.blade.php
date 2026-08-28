{{--
|--------------------------------------------------------------------------
| Submit Button with Icon Component
|--------------------------------------------------------------------------
|
| Structured submit button with indicative arrow and smooth hover animation.
| • 100% free of inline CSS or JS.
| • Hybrid support via prop ($label) or structured block ($slot).
| • Native RTL layout compatibility.
|
--}}

@props([
    'id' => null,
    'label' => null,
])

<x-ui.buttons.submit
    :id="$id"
    variant="primary"
    size="md"
    weight="bold"
    {{ $attributes->merge(['class' => 'group w-full rounded-2xl shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 flex items-center justify-center gap-2']) }}
>
    <span>{{ $label ?? $slot }}</span>

    <svg class="h-4 w-4 transition duration-300 group-hover:translate-x-1 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
</x-ui.buttons.submit>
