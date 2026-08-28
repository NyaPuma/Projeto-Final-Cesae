{{--
|-------------------------------------------------------------------------- |
Page Actions Container Component (Optimized)
|-------------------------------------------------------------------------- |
| Flexible container for aligning and spacing buttons and actions.
| • Standardized with native Tailwind flex utilities.
| • 100% free of inline CSS or JS.
|--}}
<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-2']) }}>
    {{ $slot }}
</div>
