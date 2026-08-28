@extends('ui.layout')

@section('page_key', 'stock-dashboard')

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Gestão de Stock')"
    :subtitle="__('messages.Peças, fornecedores, movimentos e alertas de stock baixo.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
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

    {{-- Summary metrics --}}
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-(--text-soft)">{{ __('stock.Valor total em stock') }}</p>
            <p id="metricTotalValue" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-(--text-soft)">{{ __('stock.Peças em catálogo') }}</p>
            <p id="metricTotalParts" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
        <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-(--text-soft)">{{ __('messages.Alertas de stock baixo') }}</p>
            <p id="metricLowStock" class="mt-2 text-2xl font-black text-(--text)">—</p>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
        <p class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('common.Ações rápidas') }}</p>
        <div class="mt-3 flex flex-wrap gap-2">
            <x-ui.page-actions.base-link :href="route('ui.stock.movements')" variant="secondary" size="sm" weight="bold">{{ __('common.Movimentos') }}</x-ui.page-actions.base-link>
            <x-ui.page-actions.base-link :href="route('ui.stock.suppliers')" variant="secondary" size="sm" weight="bold">{{ __('stock.Fornecedores') }}</x-ui.page-actions.base-link>
            @if($user && $user->isAdmin())
                <x-ui.page-actions.base-link :href="route('ui.stock.tax-rates')" variant="secondary" size="sm" weight="bold">{{ str_replace('IVA', \App\Services\LocaleService::indirectTaxLabel(), __('common.Taxas IVA')) }}</x-ui.page-actions.base-link>
                <x-ui.page-actions.base-link :href="route('ui.stock.categories')" variant="secondary" size="sm" weight="bold">{{ __('common.Categorias') }}</x-ui.page-actions.base-link>
                <x-ui.page-actions.base-link :href="route('ui.stock.plans')" variant="secondary" size="sm" weight="bold">{{ __('maintenance_plan.Planos') }}</x-ui.page-actions.base-link>
            @endif
        </div>
    </div>

    {{-- Low-stock alerts --}}
    <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
        <div class="flex items-center justify-between border-b border-(--border) px-5 py-4">
            <h2 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('messages.Peças em alerta') }}</h2>
            <a href="{{ route('ui.stock.parts') }}?status=low" class="text-xs font-bold text-primary hover:opacity-80">{{ __('common.Ver todas') }} →</a>
        </div>
        <div id="lowStockList" class="divide-y divide-(--border)">
            <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Top consumed --}}
        <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
            <div class="border-b border-(--border) px-5 py-4">
                <h2 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('stock.Top peças mais consumidas') }}</h2>
            </div>
            <div id="topConsumedList" class="divide-y divide-(--border)">
                <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
            </div>
        </div>

        {{-- Stockout forecast --}}
        <div class="rounded-2xl border border-(--border) bg-(--surface) shadow-sm">
            <div class="border-b border-(--border) px-5 py-4">
                <h2 class="text-xs font-black uppercase tracking-wider text-(--text)">{{ __('stock.Previsão de rutura de stock') }}</h2>
            </div>
            <div id="runoutList" class="divide-y divide-(--border)">
                <p class="px-5 py-8 text-center text-xs text-(--text-soft)">{{ __('ui.A carregar...') }}</p>
            </div>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection
