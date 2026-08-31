{{--
|--------------------------------------------------------------------------
| Card Component
|--------------------------------------------------------------------------
| Generic card container with an optional link state (anchor) and a loading
| skeleton state.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'href' => null,
    'loading' => false,
])

@php
    $classes = trim('ui-card' . ($loading ? ' ui-card--loading' : ''));
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}" @if ($loading) aria-busy="true" @endif>
        @if ($loading)<span class="ui-card-skeleton" aria-hidden="true"></span>@endif
        {{ $slot }}
    </a>
@else
    <div class="{{ $classes }}" @if ($loading) aria-busy="true" @endif>
        @if ($loading)<span class="ui-card-skeleton" aria-hidden="true"></span>@endif
        {{ $slot }}
    </div>
@endif
