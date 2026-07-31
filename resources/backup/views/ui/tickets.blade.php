@extends('ui.layout')

@section('page_key', 'tickets')

@section('content')
<x-ui.partials.page-card
    :title="__('Tickets')"
    :subtitle="__('Pesquise, filtre e consulte as ocorr\u00eancias registadas.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui'" :label="__('Voltar ao painel')" />
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isCommonUser())
                    <x-ui.page-actions.create-link :href="'/ui/tickets/create'" :label="__('Criar Ticket')" />
                @endif
            @endauth
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('Pesquisar em t\u00edtulo e descri\u00e7\u00e3o do ticket...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('Estado')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                <option value="">{{ __('Todos') }}</option>
                <option value="aberta">{{ __('Aberta') }}</option>
                <option value="em curso">{{ __('Em Curso') }}</option>
                <option value="fechada">{{ __('Fechada') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_priority" :label="__('Prioridade')">
            <select id="filter_priority" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                <option value="">{{ __('Todas') }}</option>
                <option value="baixa">{{ __('Baixa') }}</option>
                <option value="m\u00e9dia">{{ __('M\u00e9dia') }}</option>
                <option value="alta">{{ __('Alta') }}</option>
                <option value="cr\u00edtica">{{ __('Cr\u00edtica') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_from" :label="__('Data de abertura (De)')">
            <input id="filter_date_from" type="date" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_to" :label="__('Data at\u00e9')">
            <input id="filter_date_to" type="date" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
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
                <th class="px-5 py-4 font-bold">{{ __('T\u00edtulo') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Prioridade') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('Sala') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('T\u00e9cnico') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('A\u00e7\u00f5es') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-card>
@endsection
