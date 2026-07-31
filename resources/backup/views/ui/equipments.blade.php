@extends('ui.layout')

@section('page_key', 'equipments')

@section('content')
<x-ui.partials.page-card
    :title="__('Equipamentos')"
    :subtitle="__('Invent\u00e1rio centralizado de equipamentos, localiza\u00e7\u00f5es e estado operacional.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Voltar ao painel')" />
            <x-ui.page-actions.action-button id="btnAddEquipment" :label="__('Novo equipamento')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('Pesquise por nome, categoria ou c\u00f3digo...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('Estado Operacional')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                <option value="">{{ __('Todos') }}</option>
                <option value="active">{{ __('Operacional') }}</option>
                <option value="inactive">{{ __('Fora de Servi\u00e7o') }}</option>
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="equipmentTable"
        body_id="equipmentTableBody"
        :aria_label="__('Lista de equipamentos')"
        :loading_message="__('A carregar invent\u00e1rio de equipamentos...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('C\u00f3digo / N\u00ba S\u00e9rie') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Sala / Localiza\u00e7\u00e3o') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('A\u00e7\u00f5es') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-card>

<x-ui.equipments.form-modal />
@endsection
