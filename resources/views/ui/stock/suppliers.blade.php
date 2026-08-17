@extends('ui.layout')

@section('page_key', 'stock-suppliers')

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Fornecedores')"
    :subtitle="__('common.Gestão de fornecedores, prazos de entrega e contacto.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.dashboard')" :label="__('stock.Voltar ao Stock')" />
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.stock.suppliers.create')" :label="__('common.Novo Fornecedor')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('common.Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ str_replace('NIF', \App\Services\LocaleService::taxIdentifierLabel(), __('common.Pesquise por nome ou NIF...')) }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="suppliersTable"
        body_id="suppliersTableBody"
        :aria_label="__('common.Lista de fornecedores')"
        :loading_message="__('ui.A carregar fornecedores...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('common.Fornecedor') }}</th>
                <th class="px-5 py-4 font-bold">{{ \App\Services\LocaleService::taxIdentifierLabel() }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Contacto') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Prazo médio') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
