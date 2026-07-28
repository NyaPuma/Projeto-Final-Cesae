@extends('ui.layout')

@section('page_key', 'equipments')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Equipamentos'),
    'subtitle' => __('Inventário centralizado de equipamentos, localizações e estado operacional.'),
    'actions' => '<div class="flex flex-wrap items-center gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">'
            . '<svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddEquipment" type="button" class="hidden rounded-xl bg-orange-500 px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:bg-orange-600 cursor-pointer">+ ' . __('Novo equipamento') . '</button>'
        . '</div>'
])
    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('Pesquise por nome, categoria ou código...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('Estado Operacional')">
            <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
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
                <th class="px-5 py-4 font-bold">{{ __('Localização') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-5 py-4 text-right font-bold">{{ __('Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
@endcomponent

<x-ui.equipments.form-modal />
@endsection
