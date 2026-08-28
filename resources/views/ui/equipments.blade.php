@extends('ui.layout')

@section('page_key', 'equipments')

@section('content')
<x-ui.partials.page-header
    :title="__('equipment.Equipamentos')"
    :subtitle="__('equipment.Inventário centralizado de equipamentos, localizações e estado operacional.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.equipments.create')" :label="__('equipment.Novo equipamento')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('common.Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('common.Pesquise por nome, categoria ou código...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('common.Estado Operacional')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todos') }}</option>
                <option value="active">{{ __('common.Operacional') }}</option>
                <option value="inactive">{{ __('common.Fora de Serviço') }}</option>
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="equipmentTable"
        body_id="equipmentTableBody"
        :aria_label="__('equipment.Lista de equipamentos')"
        :loading_message="__('equipment.A carregar inventário de equipamentos...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('common.Código / Nº Série') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('equipment.Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('room.Sala / Localização') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Estado') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
