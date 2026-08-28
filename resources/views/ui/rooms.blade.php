@extends('ui.layout')

@section('page_key', 'rooms')

@section('content')
<x-ui.partials.page-header
    :title="__('room.Salas')"
    :subtitle="__('equipment.Consulte e organize as salas e equipamentos associados.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.rooms.create')" :label="__('room.Nova sala')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('common.Termo de Pesquisa')">
            <input id="filter_q" type="text" placeholder="{{ __('room.Pesquise por nome ou código da sala...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-4 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_location" :label="__('common.Localização')">
            <input id="filter_location" type="text" placeholder="{{ __('ui.Filtrar por localização...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-4 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="roomsTable"
        body_id="roomsTableBody"
        :aria_label="__('room.Lista de salas')"
        :loading_message="__('ui.A carregar listagem de salas...')"
        :columns="4"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-3.5 font-bold">{{ __('room.Nome da Sala') }}</th>
                <th class="px-5 py-3.5 font-bold">{{ __('common.Localização') }}</th>
                <th class="px-5 py-3.5 font-bold">{{ __('equipment.Equipamentos') }}</th>
                <th class="px-5 py-3.5 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
