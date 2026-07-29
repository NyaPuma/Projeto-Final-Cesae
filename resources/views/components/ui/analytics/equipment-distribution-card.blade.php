<article class="overflow-hidden rounded-3xl border border-(--border) bg-(--surface)">
    <header class="border-b border-(--border) p-8">
        <x-ui.text.eyebrow>{{ __('Inventário') }}</x-ui.text.eyebrow>
        <h2 class="mt-2 text-2xl font-bold tracking-tight">{{ __('Equipamentos') }}</h2>
        <p class="mt-3 text-sm leading-7 text-soft">{{ __('Distribuição do parque tecnológico por categoria.') }}</p>
    </header>
    <div class="p-8">
        <div class="relative mx-auto flex h-[300px] w-[300px] items-center justify-center">
            <canvas id="equipmentChart"></canvas>
            <div id="equipmentTotal" class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-5xl font-black">--</span>
                <x-ui.text.eyebrow class="mt-2">{{ __('Equipamentos') }}</x-ui.text.eyebrow>
            </div>
        </div>
        <div id="equipmentLegend" class="mt-10 space-y-3"></div>
    </div>
</article>
