@props([
    'title' => null,
    'subtitle' => null,
    'badge' => 'Dashboard',
    'animate' => true,
])

<div {{ $attributes->class(['ui-card ui-card--hero']) }}>
    {{-- Glow decorativo --}}
    <div class="ui-card__glow-top"></div>
    <div class="ui-card__glow-accent"></div>
    <div class="ui-card__overlay"></div>

    <div class="ui-card__inner">
        <header class="ui-card__header">
            <div class="ui-card__text-group">
                @if($badge)
                    <div class="ui-badge">
                        @if($animate)
                            <span class="ui-badge__ping"></span>
                        @endif
                        <span class="ui-badge__label">{{ $badge }}</span>
                    </div>
                @endif

                @if($title)
                    <h1 class="ui-card__title">{{ $title }}</h1>
                @endif

                @if(!empty($subtitle))
                    <p class="ui-card__subtitle">{{ $subtitle }}</p>
                @endif
            </div>

            @if(isset($actions))
                <div class="ui-card__actions">
                    {{ $actions }}
                </div>
            @endif
        </header>

        <div class="ui-card__content">
            {{ $slot }}
        </div>
    </div>
</div>
