@extends('ui.layout')

@section('page_key', 'equipments')

@section('content')
<x-ui.partials.page-card
    :title="__('Equipamentos')"
    :subtitle="__('Inventário centralizado de equipamentos, localizações e estado operacional.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Voltar ao painel')" />
            <x-ui.page-actions.action-button id="btnAddEquipment" :label="__('Novo equipamento')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('Pesquise por nome, categoria ou código...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('Estado Operacional')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                <option value="">{{ __('Todos') }}</option>
                <option value="active">{{ __('Operacional') }}</option>
                <option value="inactive">{{ __('Fora de Serviço') }}</option>
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="equipmentTable"
        body_id="equipmentTableBody"
        :aria_label="__('Lista de equipamentos')"
        :loading_message="__('A carregar inventário de equipamentos...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('Código / Nº Série') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Sala / Localização') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-card>

<x-ui.equipments.form-modal />
@endsection
