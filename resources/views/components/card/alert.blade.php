{{--
|--------------------------------------------------------------------------
| Alert Component
|--------------------------------------------------------------------------
| Contextual alert container with tone variant, optional title and body slot.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'variant' => 'neutral',
    'title' => null,
])

<div {{ $attributes->merge(['class' => trim('ui-card-alert ui-card-alert--' . $variant)]) }} role="alert">
    @if ($title)
        <h4 class="ui-card-alert__title">{{ $title }}</h4>
    @endif
    <div class="ui-card-alert__body">{{ $slot }}</div>
</div>
