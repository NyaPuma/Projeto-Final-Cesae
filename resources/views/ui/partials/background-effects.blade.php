@props(['class' => ''])

<div {{ $attributes->merge(['class' => "ui-background-effects $class"]) }} aria-hidden="true">
    <div class="ui-background-effects__base"></div>
    <div class="ui-background-effects__glow ui-background-effects__glow--primary"></div>
    <div class="ui-background-effects__glow ui-background-effects__glow--accent"></div>
    <div class="ui-background-effects__glow ui-background-effects__glow--secondary"></div>
</div>
