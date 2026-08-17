@extends('ui.layout')

@section('page_key', 'stock-dashboard')

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Gestão de Stock')"
    :subtitle="__('messages.Peças, fornecedores, movimentos e alertas de stock baixo.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui'" :label="__('dashboard.Voltar ao painel')" />
            <x-ui.page-actions.export-link
                :href="route('stock.reports.costs-by-equipment.pdf')"
                data-async-export="pdf"
                data-processing-label="A gerar PDF..."
                :label="__('equipment.PDF Custo por Equipamento')"
            />
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.stock.parts.create')" :label="__('stock.Nova Peça')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div data-async-message class="hidden rounded-2xl border px-5 py-4 text-sm font-medium"></div>

    {{-- Métricas resumo --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">{{ __('stock.Valor total em stock') }}</p>
            <p id="metricTotalValue" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">{{ __('stock.Peças em catálogo') }}</p>
            <p id="metricTotalParts" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">{{ __('messages.Alertas de stock baixo') }}</p>
            <p id="metricLowStock" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">{{ __('common.Ações rápidas') }}</p>
            <div class="mt-2 flex flex-wrap gap-2">
                <a href="{{ route('ui.stock.movements') }}" class="inline-flex items-center justify-center rounded-lg border border-(--border) bg-(--surface-2) px-3 py-1.5 text-[11px] font-semibold text-(--text) transition hover:bg-(--border)">{{ __('common.Movimentos') }}</a>
                <a href="{{ route('ui.stock.suppliers') }}" class="inline-flex items-center justify-center rounded-lg border border-(--border) bg-(--surface-2) px-3 py-1.5 text-[11px] font-semibold text-(--text) transition hover:bg-(--border)">{{ __('stock.Fornecedores') }}</a>
                @if($user && $user->isAdmin())
                    <a href="{{ route('ui.stock.tax-rates') }}" class="inline-flex items-center justify-center rounded-lg border border-(--border) bg-(--surface-2) px-3 py-1.5 text-[11px] font-semibold text-(--text) transition hover:bg-(--border)">{{ str_replace('IVA', \App\Services\LocaleService::indirectTaxLabel(), __('common.Taxas IVA')) }}</a>
                    <a href="{{ route('ui.stock.categories') }}" class="inline-flex items-center justify-center rounded-lg border border-(--border) bg-(--surface-2) px-3 py-1.5 text-[11px] font-semibold text-(--text) transition hover:bg-(--border)">{{ __('common.Categorias') }}</a>
                    <a href="{{ route('ui.stock.plans') }}" class="inline-flex items-center justify-center rounded-lg border border-(--border) bg-(--surface-2) px-3 py-1.5 text-[11px] font-semibold text-(--text) transition hover:bg-(--border)">{{ __('maintenance_plan.Planos') }}</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Peças em alerta --}}
    <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
        <div class="flex items-center justify-between border-b border-(--border) px-5 py-4">
            <h3 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('messages.Peças em alerta') }}</h3>
            <a href="{{ route('ui.stock.parts') }}?status=low" class="text-[11px] font-bold text-primary hover:opacity-80">{{ __('common.Ver todas') }} →</a>
        </div>
        <div id="lowStockList" class="divide-y divide-(--border)">
            <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Top consumidas --}}
        <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
            <div class="border-b border-(--border) px-5 py-4">
                <h3 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('stock.Top peças mais consumidas') }}</h3>
            </div>
            <div id="topConsumedList" class="divide-y divide-(--border)">
                <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
            </div>
        </div>

        {{-- Previsão de rutura --}}
        <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
            <div class="border-b border-(--border) px-5 py-4">
                <h3 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('stock.Previsão de rutura de stock') }}</h3>
            </div>
            <div id="runoutList" class="divide-y divide-(--border)">
                <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
            </div>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection
