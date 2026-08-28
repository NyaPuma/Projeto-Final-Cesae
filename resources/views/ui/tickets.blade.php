@extends('ui.layout')

@section('page_key', 'tickets')

@section('content')
<x-ui.partials.page-header
    :title="__('tickets.Tickets')"
    :subtitle="__('tickets.Pesquise, filtre e consulte as ocorrências registadas.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isCommonUser())
                    <x-ui.page-actions.create-link :href="'/ui/tickets/create'" :label="__('tickets.Criar Ticket')" />
                @endif
            @endauth
        </x-ui.page-actions.group>
    </x-slot:actions>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_q" :label="__('common.Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="filter_q" placeholder="{{ __('tickets.Pesquisar em título e descrição do ticket...') }}"
                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_status" :label="__('common.Estado')">
            <select id="filter_status" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                <option value="">{{ __('common.Todos') }}</option>
                <option value="aberta">{{ __('common.Aberta') }}</option>
                <option value="em curso">{{ __('common.Em Curso') }}</option>
                <option value="fechada">{{ __('common.Fechada') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_priority" :label="__('common.Prioridade')">
            <select id="filter_priority" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                <option value="">{{ __('common.Todas') }}</option>
                <option value="baixa">{{ __('tickets.Baixa') }}</option>
                <option value="média">{{ __('common.Média') }}</option>
                <option value="alta">{{ __('tickets.Alta') }}</option>
                <option value="crítica">{{ __('common.Crítica') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_from" :label="__('ticket_detail.Data de abertura (De)')">
            <input id="filter_date_from" type="date" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_date_to" :label="__('common.Data até')">
            <input id="filter_date_to" type="date" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="ticketsTable"
        body_id="ticketsBody"
        :aria_label="__('tickets.Lista de tickets')"
        :loading_message="__('tickets.A carregar listagem de tickets...')"
        :columns="8"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('common.ID') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Título') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Prioridade') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Estado') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('equipment.Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('room.Sala') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Técnico') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
