@extends('ui.layout')

@section('page_key', 'tickets')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Tickets'),
    'subtitle' => __('Pesquise, filtre e consulte as ocorrências registadas.'),
    'actions' => '<div class="flex flex-wrap gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">'
            . '<svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">'
                . '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>'
            . '</svg> '
            . __('Voltar ao painel')
        . '</a>'
        . (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isCommonUser())
            ? '<a href="' . route('ui.tickets.create') . '" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90">+ ' . __('Criar Ticket') . '</a>'
            : '')
        . '</div>'
])
    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('Pesquisar em título e descrição do ticket...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('Estado')">
            <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todos') }}</option>
                <option value="aberta">{{ __('Aberta') }}</option>
                <option value="em curso">{{ __('Em Curso') }}</option>
                <option value="fechada">{{ __('Fechada') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_priority" :label="__('Prioridade')">
            <select id="filter_priority" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todas') }}</option>
                <option value="baixa">{{ __('Baixa') }}</option>
                <option value="média">{{ __('Média') }}</option>
                <option value="alta">{{ __('Alta') }}</option>
                <option value="crítica">{{ __('Crítica') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_from" :label="__('Data de abertura (De)')">
            <input id="filter_date_from" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_to" :label="__('Data até')">
            <input id="filter_date_to" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="ticketsTable"
        body_id="ticketsBody"
        :aria_label="__('Lista de tickets')"
        :loading_message="__('A carregar listagem de tickets...')"
        :columns="8"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('ID') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Título') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Prioridade') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Sala') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Técnico') }}</th>
                <th class="px-5 py-4 text-right font-bold">{{ __('Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
@endcomponent
@endsection
