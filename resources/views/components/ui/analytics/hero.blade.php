<section class="relative overflow-hidden rounded-3xl border border-(--border) bg-(--surface)">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-primary/10 blur-[120px]"></div>
        <div class="absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-blue-500/5 blur-[90px]"></div>
    </div>

    <div class="relative p-8 lg:p-10">
        <div class="grid gap-10 xl:grid-cols-[1.5fr_0.5fr]">
            <div>
                <x-ui.text.pill tone="primary" size="sm" class="gap-2 px-4 py-2">
                    <span class="h-2.5 w-2.5 animate-pulse rounded-full bg-primary"></span>
                    {{ __('Dashboard Analítico') }}
                </x-ui.text.pill>
                <h1 class="mt-6 text-4xl font-black tracking-tight">{{ __('Centro de Monitorização da Plataforma') }}</h1>
                <p class="mt-5 max-w-3xl text-[15px] leading-8 text-soft">
                    {{ __('Visualize em tempo real o desempenho operacional, acompanhe indicadores de manutenção, distribuição dos equipamentos, produtividade da equipa técnica e evolução das ocorrências registadas.') }}
                </p>
            </div>

            <div class="flex flex-col justify-between rounded-3xl border border-(--border) bg-(--surface-2) p-7">
                <div>
                    <x-ui.text.eyebrow as="p">{{ __('Estado') }}</x-ui.text.eyebrow>
                    <h2 class="mt-4 text-3xl font-black">{{ __('Operacional') }}</h2>
                    <p class="mt-2 text-sm text-soft">{{ __('Todos os serviços encontram-se disponíveis.') }}</p>
                </div>
                <div class="mt-10 inline-flex items-center gap-3">
                    <span class="h-3 w-3 animate-pulse rounded-full bg-emerald-500"></span>
                    <span class="font-semibold text-emerald-500">{{ __('Online') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
