{{--
|--------------------------------------------------------------------------
| Equipment Chart Card Component
|--------------------------------------------------------------------------
|
| Specialized card for statistical charts with central indicator and legend.
| • 100% free of inline CSS or JS.
| • Highly parameterizable via props for titles, IDs and legends.
| • CSS variable syntax corrected and safe for Tailwind.
|
--}}

@props([
    'eyebrow' => __('common.Prioridades'),
    'title' => __('tickets.Prioridade dos Tickets'),
    'description' => __('tickets.Distribuição dos tickets por prioridade de resposta e intervenção.'),
    'canvasId' => 'equipmentChart',
    'totalId' => 'equipmentTotal',
    'legendId' => 'equipmentLegend',
    'totalLabel' => __('tickets.Tickets'),
])

<article {{ $attributes->class(['overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]']) }}>
    <header class="border-b border-[var(--border)] p-8">
        @if($eyebrow)
            <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
        @endif

        @if($title)
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-[var(--text)]">{{ $title }}</h2>
        @endif

        @if($description)
            <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ $description }}</p>
        @endif
    </header>

    <div class="p-8">
        <div class="relative mx-auto flex h-[300px] w-[300px] items-center justify-center">
            <canvas id="{{ $canvasId }}"></canvas>

            <div id="{{ $totalId }}" class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-5xl font-black text-[var(--text)]">--</span>
                @if($totalLabel)
                    <x-ui.text.eyebrow class="mt-2">{{ $totalLabel }}</x-ui.text.eyebrow>
                @endif
            </div>
        </div>

        <div id="{{ $legendId }}" class="mt-10 space-y-3"></div>

        {{ $slot }}
    </div>
</article>
