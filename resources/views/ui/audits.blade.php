@extends('ui.layout')

@section('page_key', 'audits')

@section('content')
<x-ui.partials.page-card
    :title="__('Auditoria')"
    :subtitle="__('Monitorização completa das operações efetuadas pelos utilizadores e pelos processos automáticos do sistema.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Voltar ao painel')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Pesquisa Geral')" span="sm:col-span-2 lg:col-span-3">
            <x-ui.form.input id="filter_q" name="q" :placeholder="__('Pesquise por utilizador, entidade, operação ou ID do log...')" class="rounded-xl px-3 py-2.5 text-xs placeholder-[var(--text-soft)] focus:ring-2 focus:ring-primary/10" />
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_event" :label="__('Filtrar por Evento')">
            <x-ui.form.select id="filter_event" name="event" class="rounded-xl px-3 py-2.5 text-xs focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todos os eventos') }}</option>
            </x-ui.form.select>
        </x-ui.listing.filter-field>

        <x-slot name="afterActions">
            <div class="flex items-center gap-3">
                <x-ui.text.pill tone="warning" size="xs" class="rounded-lg border-0">
                    {{ __('Últimos 200 registos') }}
                </x-ui.text.pill>
            </div>
        </x-slot>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="auditsTable"
        body_id="auditsTableBody"
        :aria_label="__('Lista de auditoria')"
        :loading_message="__('A carregar registos de auditoria...')"
        :columns="8"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('Log') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Utilizador / Operador') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Entidade') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Referência') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Evento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado Anterior') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Novo Estado') }}</th>
                <th class="px-5 py-4 text-right font-bold">{{ __('Data') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-card>
@endsection
