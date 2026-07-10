@extends('ui.layout')

@section('content')

<script>
// Esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Centro Analítico',
    'subtitle' => 'Monitorização operacional da plataforma de gestão de avarias.',
    'actions' => '
        <div class="flex flex-wrap gap-3">

            <a href="/analytics/export/csv"
               class="btn btn-secondary"
               id="btnExportCsv">

                Exportar CSV

            </a>

            <a href="/analytics/export/pdf"
               class="btn btn-secondary"
               id="btnExportPdf">

                Exportar PDF

            </a>

            <a href="/analytics/export/excel"
               class="btn btn-primary"
               id="btnExportExcel">

                Exportar Excel

            </a>

        </div>
    ',
])

<div class="space-y-10">

    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <section
        class="relative overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

        {{-- Background --}}
        <div class="pointer-events-none absolute inset-0">

            <div
                class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-primary/10 blur-[120px]">
            </div>

            <div
                class="absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-blue-500/5 blur-[90px]">
            </div>

        </div>

        <div class="relative p-8 lg:p-10">

            <div class="grid gap-10 xl:grid-cols-[1.5fr_0.5fr]">

                {{-- Texto Principal --}}
                <div>

                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-primary">

                        <span
                            class="h-2.5 w-2.5 rounded-full bg-primary animate-pulse">
                        </span>

                        Dashboard Analítico

                    </span>

                    <h1
                        class="mt-6 text-4xl font-black tracking-tight">

                        Centro de Monitorização da Plataforma

                    </h1>

                    <p
                        class="mt-5 max-w-3xl text-[15px] leading-8 text-soft">

                        Visualize em tempo real o desempenho operacional,
                        acompanhe indicadores de manutenção, distribuição dos
                        equipamentos, produtividade da equipa técnica e
                        evolução das ocorrências registadas.

                    </p>

                </div>

                {{-- Estado --}}
                <div
                    class="flex flex-col justify-between rounded-3xl border border-[var(--border)] bg-[var(--surface-2)] p-7">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            Estado

                        </p>

                        <h2
                            class="mt-4 text-3xl font-black">

                            Operacional

                        </h2>

                        <p
                            class="mt-2 text-sm text-soft">

                            Todos os serviços encontram-se disponíveis.

                        </p>

                    </div>

                    <div
                        class="mt-10 inline-flex items-center gap-3">

                        <span
                            class="h-3 w-3 rounded-full bg-emerald-500 animate-pulse">
                        </span>

                        <span
                            class="font-semibold text-emerald-500">

                            Online

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ========================================================= --}}
    {{-- KPI Dashboard --}}
    {{-- ========================================================= --}}

    <section>

        <div class="mb-8 flex items-end justify-between">

            <div>

                <span
                    class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                    Indicadores Operacionais

                </span>

                <h2
                    class="mt-2 text-2xl font-bold tracking-tight">

                    Resumo da Plataforma

                </h2>

                <p
                    class="mt-2 max-w-2xl text-sm text-soft">

                    Indicadores principais da atividade do sistema. Os valores
                    são atualizados automaticamente a partir da base de dados.

                </p>

            </div>

            <div
                class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3 lg:flex lg:flex-col">

                <span
                    class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                    Atualização

                </span>

                <span
                    class="mt-1 text-lg font-bold">

                    Tempo Real

                </span>

            </div>

        </div>

        <div
            id="kpiPanel"
            class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Placeholder enquanto os dados são carregados --}}

            @for($i = 0; $i < 4; $i++)

                <article
                    class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

                    <div class="p-6">

                        <div
                            class="h-4 w-28 animate-pulse rounded-full bg-[var(--surface-2)]">
                        </div>

                        <div
                            class="mt-6 h-10 w-24 animate-pulse rounded-xl bg-[var(--surface-2)]">
                        </div>

                        <div
                            class="mt-6 h-3 w-40 animate-pulse rounded-full bg-[var(--surface-2)]">
                        </div>

                        <div
                            class="mt-8 flex items-center justify-between">

                            <div
                                class="h-8 w-20 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                            <div
                                class="h-8 w-8 animate-pulse rounded-2xl bg-[var(--surface-2)]">
                            </div>

                        </div>

                    </div>

                </article>

            @endfor

        </div>

    </section>

        {{-- ========================================================= --}}
    {{-- Dashboard Principal --}}
    {{-- ========================================================= --}}

    <section class="grid gap-8 2xl:grid-cols-[2fr_1fr]">

        {{-- ===================================================== --}}
        {{-- Tickets --}}
        {{-- ===================================================== --}}

        <article
            class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

            <header
                class="flex flex-col gap-6 border-b border-[var(--border)] p-8 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <span
                        class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                        Desempenho

                    </span>

                    <h2
                        class="mt-2 text-2xl font-bold tracking-tight">

                        Tickets por Estado

                    </h2>

                    <p
                        class="mt-3 max-w-2xl text-sm leading-7 text-soft">

                        Distribuição atual das ocorrências de manutenção
                        registadas na plataforma.

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-4">

                    <p
                        class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                        Atualização

                    </p>

                    <p
                        class="mt-2 text-lg font-bold">

                        Em tempo real

                    </p>

                </div>

            </header>

            <div class="p-8">

                <div class="h-[420px]">

                    <canvas id="ticketChart"></canvas>

                </div>

            </div>

        </article>

        {{-- ===================================================== --}}
        {{-- Equipamentos --}}
        {{-- ===================================================== --}}

        <article
            class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

            <header
                class="border-b border-[var(--border)] p-8">

                <span
                    class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                    Inventário

                </span>

                <h2
                    class="mt-2 text-2xl font-bold tracking-tight">

                    Equipamentos

                </h2>

                <p
                    class="mt-3 text-sm leading-7 text-soft">

                    Distribuição do parque tecnológico por categoria.

                </p>

            </header>

            <div class="p-8">

                <div
                    class="relative mx-auto flex h-[300px] w-[300px] items-center justify-center">

                    <canvas id="equipmentChart"></canvas>

                    <div
                        id="equipmentTotal"
                        class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">

                        <span
                            class="text-5xl font-black">

                            --

                        </span>

                        <span
                            class="mt-2 text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            Equipamentos

                        </span>

                    </div>

                </div>

                <div
                    id="equipmentLegend"
                    class="mt-10 space-y-3">

                    {{-- A legenda será preenchida pelo JavaScript --}}

                </div>

            </div>

        </article>

    </section>

        {{-- ========================================================= --}}
    {{-- Indicadores Operacionais --}}
    {{-- ========================================================= --}}

    <section>

        <div class="mb-8">

            <span
                class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                Desempenho Operacional

            </span>

            <h2
                class="mt-2 text-2xl font-bold tracking-tight">

                Estado do Sistema

            </h2>

            <p
                class="mt-3 max-w-3xl text-sm leading-7 text-soft">

                Indicadores complementares que permitem acompanhar a eficiência
                da equipa técnica, disponibilidade do sistema e qualidade do
                serviço prestado.

            </p>

        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            {{-- MTTR --}}

            <article
                class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">

                <div
                    class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            MTTR

                        </p>

                        <h3
                            id="metricMttr"
                            class="mt-4 text-4xl font-black">

                            --

                        </h3>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500/10">

                        <svg class="h-7 w-7 text-emerald-500"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 8v4l3 3"/>

                            <circle cx="12"
                                    cy="12"
                                    r="9"/>

                        </svg>

                    </div>

                </div>

                <p
                    class="mt-6 text-sm text-soft">

                    Tempo médio necessário para resolver uma ocorrência.

                </p>

            </article>

            {{-- Espera --}}

            <article
                class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">

                <div
                    class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            Espera

                        </p>

                        <h3
                            id="metricWaiting"
                            class="mt-4 text-4xl font-black">

                            --

                        </h3>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500/10">

                        <svg class="h-7 w-7 text-blue-500"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 6v6l4 2"/>

                        </svg>

                    </div>

                </div>

                <p
                    class="mt-6 text-sm text-soft">

                    Tempo médio até um técnico assumir a intervenção.

                </p>

            </article>

            {{-- Disponibilidade --}}

            <article
                class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">

                <div
                    class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            Disponibilidade

                        </p>

                        <h3
                            id="metricAvailability"
                            class="mt-4 text-4xl font-black">

                            99.9%

                        </h3>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/10">

                        <svg class="h-7 w-7 text-purple-500"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                    </div>

                </div>

                <p
                    class="mt-6 text-sm text-soft">

                    Disponibilidade estimada da plataforma.

                </p>

            </article>

            {{-- SLA --}}

            <article
                class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7">

                <div
                    class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                            SLA

                        </p>

                        <h3
                            id="metricSla"
                            class="mt-4 text-4xl font-black">

                            --

                        </h3>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-500/10">

                        <svg class="h-7 w-7 text-amber-500"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12l2 2 4-4"/>

                        </svg>

                    </div>

                </div>

                <p
                    class="mt-6 text-sm text-soft">

                    Percentagem de intervenções dentro do tempo previsto.

                </p>

            </article>

        </div>

    </section>

        {{-- ========================================================= --}}
    {{-- Atividade Recente --}}
    {{-- ========================================================= --}}

    <section>

        <div class="mb-8 flex items-end justify-between">

            <div>

                <span
                    class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                    Histórico

                </span>

                <h2
                    class="mt-2 text-2xl font-bold tracking-tight">

                    Atividade Recente

                </h2>

                <p
                    class="mt-3 max-w-3xl text-sm leading-7 text-soft">

                    Últimas ações registadas na plataforma. Esta secção permite
                    acompanhar rapidamente a atividade operacional sem consultar
                    os detalhes individuais dos tickets.

                </p>

            </div>

            <span
                class="rounded-full border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2 text-xs font-semibold uppercase tracking-[0.16em]">

                Últimas 24 horas

            </span>

        </div>

        <div
            class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

            <div
                id="activityTimeline"
                class="divide-y divide-[var(--border)]">

                {{-- Item 1 --}}

                <div class="flex items-start gap-5 p-6">

                    <div
                        class="mt-1 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10">

                        <div
                            class="h-3 w-3 rounded-full bg-emerald-500">
                        </div>

                    </div>

                    <div class="flex-1">

                        <div class="flex flex-wrap items-center justify-between gap-3">

                            <h3 class="font-semibold">

                                A carregar atividade...

                            </h3>

                            <span class="text-xs text-soft">

                                --

                            </span>

                        </div>

                        <p class="mt-2 text-sm text-soft">

                            A obter os eventos mais recentes da plataforma.

                        </p>

                    </div>

                </div>

                {{-- Placeholder --}}

                @for($i = 0; $i < 4; $i++)

                    <div class="flex items-start gap-5 p-6">

                        <div
                            class="h-12 w-12 animate-pulse rounded-2xl bg-[var(--surface-2)]">
                        </div>

                        <div class="flex-1">

                            <div
                                class="h-4 w-60 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                            <div
                                class="mt-4 h-3 w-full animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                            <div
                                class="mt-2 h-3 w-2/3 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                        </div>

                    </div>

                @endfor

            </div>

        </div>

    </section>

        {{-- ========================================================= --}}
    {{-- Resumo Operacional --}}
    {{-- ========================================================= --}}

    <section>

        <div class="mb-8">

            <span
                class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                Estatísticas

            </span>

            <h2
                class="mt-2 text-2xl font-bold tracking-tight">

                Resumo Operacional

            </h2>

            <p
                class="mt-3 max-w-3xl text-sm leading-7 text-soft">

                Consulte rapidamente os equipamentos com maior número de ocorrências,
                as salas mais afetadas e os técnicos mais ativos da plataforma.

            </p>

        </div>

        <div class="grid gap-8 xl:grid-cols-3">

            {{-- ================================================= --}}
            {{-- Equipamentos --}}
            {{-- ================================================= --}}

            <article
                class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

                <header
                    class="border-b border-[var(--border)] p-6">

                    <h3 class="text-lg font-bold">

                        Equipamentos com Mais Avarias

                    </h3>

                    <p class="mt-2 text-sm text-soft">

                        Ranking dos equipamentos mais intervencionados.

                    </p>

                </header>

                <div
                    id="topEquipments"
                    class="divide-y divide-[var(--border)]">

                    @for($i = 0; $i < 5; $i++)

                        <div class="flex items-center justify-between p-5">

                            <div class="flex items-center gap-4">

                                <div
                                    class="h-10 w-10 animate-pulse rounded-xl bg-[var(--surface-2)]">
                                </div>

                                <div>

                                    <div
                                        class="h-4 w-36 animate-pulse rounded-full bg-[var(--surface-2)]">
                                    </div>

                                    <div
                                        class="mt-2 h-3 w-24 animate-pulse rounded-full bg-[var(--surface-2)]">
                                    </div>

                                </div>

                            </div>

                            <div
                                class="h-8 w-12 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                        </div>

                    @endfor

                </div>

            </article>

            {{-- ================================================= --}}
            {{-- Salas --}}
            {{-- ================================================= --}}

            <article
                class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

                <header
                    class="border-b border-[var(--border)] p-6">

                    <h3 class="text-lg font-bold">

                        Salas Mais Afetadas

                    </h3>

                    <p class="mt-2 text-sm text-soft">

                        Locais com maior número de ocorrências.

                    </p>

                </header>

                <div
                    id="topRooms"
                    class="divide-y divide-[var(--border)]">

                    @for($i = 0; $i < 5; $i++)

                        <div class="flex items-center justify-between p-5">

                            <div>

                                <div
                                    class="h-4 w-40 animate-pulse rounded-full bg-[var(--surface-2)]">
                                </div>

                                <div
                                    class="mt-2 h-3 w-28 animate-pulse rounded-full bg-[var(--surface-2)]">
                                </div>

                            </div>

                            <div
                                class="h-8 w-12 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                        </div>

                    @endfor

                </div>

            </article>

            {{-- ================================================= --}}
            {{-- Técnicos --}}
            {{-- ================================================= --}}

            <article
                class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

                <header
                    class="border-b border-[var(--border)] p-6">

                    <h3 class="text-lg font-bold">

                        Técnicos Mais Ativos

                    </h3>

                    <p class="mt-2 text-sm text-soft">

                        Colaboradores com maior número de intervenções.

                    </p>

                </header>

                <div
                    id="topTechnicians"
                    class="divide-y divide-[var(--border)]">

                    @for($i = 0; $i < 5; $i++)

                        <div class="flex items-center justify-between p-5">

                            <div class="flex items-center gap-4">

                                <div
                                    class="h-10 w-10 animate-pulse rounded-full bg-[var(--surface-2)]">
                                </div>

                                <div>

                                    <div
                                        class="h-4 w-32 animate-pulse rounded-full bg-[var(--surface-2)]">
                                    </div>

                                    <div
                                        class="mt-2 h-3 w-20 animate-pulse rounded-full bg-[var(--surface-2)]">
                                    </div>

                                </div>

                            </div>

                            <div
                                class="h-8 w-12 animate-pulse rounded-full bg-[var(--surface-2)]">
                            </div>

                        </div>

                    @endfor

                </div>

            </article>

        </div>

    </section>

        {{-- ========================================================= --}}
    {{-- Estado Global / Mensagens --}}
    {{-- ========================================================= --}}

    <div
        id="analyticsMessage"
        class="hidden rounded-2xl border px-5 py-4 text-sm font-medium">
    </div>

</div>

    {{-- ========================================================= --}}
    {{-- Rodapé Informativo --}}
    {{-- ========================================================= --}}

    <section
        class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)]">

        <div
            class="flex flex-col gap-8 p-8 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <span
                    class="text-xs font-semibold uppercase tracking-[0.18em] text-soft">

                    Sistema

                </span>

                <h2
                    class="mt-2 text-2xl font-bold tracking-tight">

                    Dashboard Operacional

                </h2>

                <p
                    class="mt-3 max-w-3xl text-sm leading-7 text-soft">

                    Os indicadores apresentados são atualizados automaticamente
                    através da plataforma de gestão de avarias, permitindo uma
                    visão consolidada da atividade operacional, equipamentos,
                    técnicos e desempenho global do sistema.

                </p>

            </div>

            <div
                class="grid gap-4 sm:grid-cols-3">

                <div
                    class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-5 text-center">

                    <p
                        class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                        Estado

                    </p>

                    <p
                        class="mt-3 text-lg font-bold text-emerald-500">

                        Online

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-5 text-center">

                    <p
                        class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                        Atualização

                    </p>

                    <p
                        class="mt-3 text-lg font-bold">

                        Tempo Real

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-5 text-center">

                    <p
                        class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                        Disponibilidade

                    </p>

                    <p
                        class="mt-3 text-lg font-bold text-blue-500">

                        99.9%

                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

{{-- Mensagens do Dashboard --}}

<div
    id="analyticsMessage"
    class="hidden mt-6 rounded-2xl border px-5 py-4 text-sm font-medium">
</div>

@endcomponent

@endsection

@endcomponent

@endsection

@push('scripts')

@endpush
