@extends('ui.layout')

@section('page_key', 'rooms')

@section('content')
<x-ui.partials.page-card
    :title="__('Salas')"
    :subtitle="__('Consulte e organize as salas e a sua relação com os equipamentos do inventário.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Voltar ao painel')" />
            <x-ui.page-actions.action-button id="btnAddRoom" :label="__('Nova sala')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-2">
            <input id="filter_q" type="text" placeholder="{{ __('Pesquise por nome ou código da sala...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_location" :label="__('Edifício / Localização')">
            <input id="filter_location" type="text" placeholder="{{ __('Filtrar por edifício...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="roomsTable"
        body_id="roomsTableBody"
        :aria_label="__('Lista de salas')"
        :loading_message="__('A carregar listagem de salas...')"
        :columns="4"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-3.5 font-bold">{{ __('Nome da Sala') }}</th>
                <th class="px-5 py-3.5 font-bold">{{ __('Localização') }}</th>
                <th class="px-5 py-3.5 font-bold">{{ __('Equipamentos') }}</th>
                <th class="px-5 py-3.5 text-right font-bold">{{ __('Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-card>

<x-ui.rooms.form-modal />
@endsection
