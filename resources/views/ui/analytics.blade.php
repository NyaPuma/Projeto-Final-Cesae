@extends('ui.layout')

@section('page_key', 'analytics')

@section('content')
<x-ui.partials.page-card
    :title="__('Centro Analítico')"
    :subtitle="__('Monitorização operacional da plataforma de gestão de avarias.')"
>
    <x-slot:actions>
        <x-ui.analytics.export-actions />
    </x-slot:actions>

    <div class="space-y-8">
        <x-ui.analytics.hero />

        <section>
            <x-ui.analytics.section-heading
                :eyebrow="__('Indicadores Operacionais')"
                :title="__('Resumo da Plataforma')"
                :description="__('Indicadores principais da atividade do sistema. Os valores são atualizados automaticamente a partir da base de dados.')"
            >
                <x-slot:aside>
                    <x-ui.analytics.aside-card :label="__('Atualização')" :value="__('Tempo Real')" class="px-5 py-3" />
                </x-slot:aside>
            </x-ui.analytics.section-heading>

            <div id="kpiPanel" class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @for ($i = 0; $i < 4; $i++)
                    <article class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">
                        <div class="p-6">
                            <div class="h-4 w-28 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                            <div class="mt-6 h-10 w-24 animate-pulse rounded-xl bg-[var(--surface-2)]"></div>
                            <div class="mt-6 h-3 w-40 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                            <div class="mt-8 flex items-center justify-between">
                                <div class="h-8 w-20 animate-pulse rounded-full bg-[var(--surface-2)]"></div>
                                <div class="h-8 w-8 animate-pulse rounded-2xl bg-[var(--surface-2)]"></div>
                            </div>
                        </div>
                    </article>
                @endfor
            </div>
        </section>

        <section class="grid gap-8 2xl:grid-cols-[1.2fr_0.8fr]">
            <x-ui.analytics.chart-card
                :eyebrow="__('Desempenho')"
                :title="__('Tickets por Estado')"
                :description="__('Distribuição atual das ocorrências de manutenção registadas na plataforma.')"
                canvas_id="statusChart"
                height_class="h-[420px]"
            >
                <x-slot:aside>
                    <x-ui.analytics.aside-card :label="__('Atualização')" :value="__('Em tempo real')" />
                </x-slot:aside>
            </x-ui.analytics.chart-card>

            <x-ui.analytics.equipment-distribution-card />
        </section>

        <section class="grid gap-8 xl:grid-cols-2">
            <x-ui.analytics.chart-card
                :eyebrow="__('Evolução')"
                :title="__('Tickets nos Últimos Meses')"
                :description="__('Comparação entre tickets abertos, em curso e fechados.')"
                canvas_id="trendChart"
            />

            <x-ui.analytics.chart-card
                :eyebrow="__('Custos')"
                :title="__('Custo Mensal')"
                :description="__('Despesas acumuladas por intervenção concluída.')"
                canvas_id="costChart"
            />
        </section>

        <section>
            <x-ui.analytics.section-heading
                :eyebrow="__('Estado do Sistema')"
                :title="__('Indicadores Operacionais')"
                :description="__('Tempo médio de resolução, SLA, disponibilidade e tempo de espera até a atribuição.')"
            />

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                <x-ui.analytics.metric-card :eyebrow="__('MTTR')" value_id="metricMttr" :description="__('Tempo médio necessário para resolver uma ocorrência.')" icon_bg_class="bg-emerald-500/10" icon_color_class="text-emerald-500" :icon="'<svg class=&quot;h-7 w-7 text-emerald-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M12 8v4l3 3&quot; /><circle cx=&quot;12&quot; cy=&quot;12&quot; r=&quot;9&quot; /></svg>'" />
                <x-ui.analytics.metric-card :eyebrow="__('Espera')" value_id="metricWaiting" :description="__('Tempo médio até um técnico assumir a intervenção.')" icon_bg_class="bg-blue-500/10" icon_color_class="text-blue-500" :icon="'<svg class=&quot;h-7 w-7 text-blue-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M12 6v6l4 2&quot; /></svg>'" />
                <x-ui.analytics.metric-card :eyebrow="__('Disponibilidade')" value_id="metricAvailability" default_value="99.9%" :description="__('Disponibilidade estimada da plataforma.')" icon_bg_class="bg-purple-500/10" icon_color_class="text-purple-500" :icon="'<svg class=&quot;h-7 w-7 text-purple-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M5 13l4 4L19 7&quot; /></svg>'" />
                <x-ui.analytics.metric-card :eyebrow="__('SLA')" value_id="metricSla" :description="__('Percentagem de intervenções dentro do tempo previsto.')" icon_bg_class="bg-amber-500/10" icon_color_class="text-amber-500" :icon="'<svg class=&quot;h-7 w-7 text-amber-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M9 12l2 2 4-4&quot; /></svg>'" />
            </div>
        </section>

        <section>
            <x-ui.analytics.section-heading
                :eyebrow="__('Histórico')"
                :title="__('Atividade Recente')"
                :description="__('Últimas ações registadas na plataforma para acompanhar rapidamente a atividade operacional.')"
            >
                <x-slot:aside>
                    <x-ui.analytics.aside-pill :label="__('Últimas 24 horas')" />
                </x-slot:aside>
            </x-ui.analytics.section-heading>

            <x-ui.analytics.activity-timeline-card />
        </section>

        <section>
            <x-ui.analytics.section-heading
                :eyebrow="__('Estatísticas')"
                :title="__('Resumo Operacional')"
                :description="__('Consulte rapidamente os equipamentos mais afetados, as salas mais recorrentes e os técnicos mais ativos.')"
            />

            <div class="grid gap-8 xl:grid-cols-3">
                <x-ui.analytics.list-card :title="__('Equipamentos com Mais Avarias')" :description="__('Ranking dos equipamentos mais intervencionados.')" container_id="topEquipments" />
                <x-ui.analytics.list-card :title="__('Salas Mais Afetadas')" :description="__('Locais com maior número de ocorrências.')" container_id="topRooms" />
                <x-ui.analytics.list-card :title="__('Técnicos Mais Ativos')" :description="__('Colaboradores com maior número de intervenções.')" container_id="topTechnicians" />
            </div>
        </section>

        <div id="analyticsMessage" class="hidden rounded-2xl border px-5 py-4 text-sm font-medium"></div>
    </div>
</x-ui.partials.page-card>
@endsection
