@extends('ui.layout')

@section('page_key', 'audits')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Auditoria'),
    'subtitle' => __('Monitorização completa das operações efetuadas pelos utilizadores e pelos processos automáticos do sistema.'),
    'actions' => '<div class="flex flex-wrap gap-2"><a href="' . route('ui.index') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]"><svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel') . '</a></div>'
])
    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Pesquisa Geral')" span="sm:col-span-2 lg:col-span-3">
            <input id="filter_q" placeholder="{{ __('Pesquise por utilizador, entidade, operação ou ID do log...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_event" :label="__('Filtrar por Evento')">
            <select id="filter_event" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todos os eventos') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-slot name="afterActions">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-500/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-amber-800 dark:text-amber-400">
                    {{ __('Últimos 200 registos') }}
                </span>
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
@endcomponent
@endsection
