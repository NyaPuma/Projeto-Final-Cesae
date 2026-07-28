@extends('ui.layout')

@section('page_key', 'rooms')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Salas'),
    'subtitle' => __('Consulte e organize as salas e a sua relação com os equipamentos do inventário.'),
    'actions' => '<div class="flex flex-wrap items-center gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">'
            . '<svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> '
            . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddRoom" type="button" class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:bg-orange-600 cursor-pointer">+ ' . __('Nova sala') . '</button>'
        . '</div>'
])
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
@endcomponent

<x-ui.rooms.form-modal />
@endsection
