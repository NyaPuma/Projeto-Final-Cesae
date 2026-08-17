@extends('ui.layout')

@section('page_key', 'stock-parts')

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Peças')"
    :subtitle="__('stock.Catálogo de peças, controlo de stock e localização.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.dashboard')" :label="__('stock.Voltar ao Stock')" />
            <x-ui.page-actions.export-link :href="route('stock.reports.low-stock.csv')" :label="__('stock.CSV Stock Baixo')" />
            <x-ui.page-actions.export-link :href="route('stock.reports.inventory.csv')" :label="__('stock.CSV Inventário')" />
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.stock.parts.create')" :label="__('stock.Nova Peça')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('common.Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('common.Pesquise por nome, SKU, marca ou referência...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('stock.Estado de Stock')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todos') }}</option>
                <option value="low">{{ __('stock.Stock baixo') }}</option>
                <option value="out">{{ __('common.Esgotado') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_category" :label="__('common.Categoria')">
            <select id="filter_category" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todas') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="partsTable"
        body_id="partsTableBody"
        :aria_label="__('stock.Lista de peças')"
        :loading_message="__('stock.A carregar peças...')"
        :columns="7"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('common.SKU') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('stock.Peça') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('stock.Stock') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Preço') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Localização') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Estado') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
