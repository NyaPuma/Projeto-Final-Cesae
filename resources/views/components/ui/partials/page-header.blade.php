{{--
|-------------------------------------------------------------------------- |
| Page Header Component (no card)
|-------------------------------------------------------------------------- |
| Structural page-header component without a grouping container.
| • Header: badge, title, subtitle and actions.
| • Content is rendered below in independent sections (space-y-6).
| --}}
@props([
    'title' => null,
    'subtitle' => null,
    'badge' => 'Dashboard',
    'animate' => true,
])

<div {{ $attributes }}>
    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
        <div class="space-y-2">
            @if($badge)
                <div class="flex items-center gap-3">
                    @if($animate)
                        <span class="relative flex h-3 w-3" aria-hidden="true">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-warning/50"></span>
                            <span class="relative inline-flex h-3 w-3 rounded-full bg-warning"></span>
                        </span>
                    @endif

                    <span class="text-xs font-bold uppercase tracking-[0.30em] text-[var(--text-soft)]">
                        {{ $badge }}
                    </span>
                </div>
            @endif

            @if($title)
                <h1 class="text-2xl font-black tracking-tight text-[var(--text)]">
                    {{ $title }}
                </h1>
            @endif

            @if(!empty($subtitle))
                <p class="max-w-3xl text-sm leading-6 text-[var(--text-soft)]">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        @if(isset($actions))
            <div class="flex flex-wrap items-center gap-3">
                {{ $actions }}
            </div>
        @endif
    </div>

    <div class="mt-6 space-y-6">
        {{ $slot }}
    </div>
</div>
