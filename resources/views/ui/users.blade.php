@extends('ui.layout')

@section('page_key', 'users')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Utilizadores'),
    'subtitle' => __('Consulte as contas dos utilizadores e os respetivos perfis de acesso ao sistema.'),
    'actions' => '<div class="flex flex-wrap gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]">'
            . '<svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> '
            . __('Voltar ao painel')
        . '</a>'
        . '<a href="' . route('ui.users.create') . '" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-xl px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90">+ ' . __('Criar Utilizador') . '</a>'
        . '</div>'
])
    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="usersSearch" :label="__('Termo de Pesquisa')" span="sm:col-span-2 lg:col-span-3 xl:col-span-4">
            <input id="usersSearch" placeholder="{{ __('Pesquise por nome, email...') }}"
                class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="usersRole" :label="__('Perfil')">
            <select id="usersRole" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todos') }}</option>
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="usersStatus" :label="__('Estado')">
            <select id="usersStatus" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/10">
                <option value="">{{ __('Todos') }}</option>
                <option value="active">{{ __('Ativos') }}</option>
                <option value="inactive">{{ __('Inativos') }}</option>
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="usersTable"
        body_id="usersTableBody"
        :aria_label="__('Lista de utilizadores')"
        :loading_message="__('A carregar listagem de utilizadores...')"
        :columns="6"
    >
        <x-slot:head>
            <tr>
                <th class="px-6 py-4 font-bold">{{ __('ID') }}</th>
                <th class="px-6 py-4 font-bold">{{ __('Nome') }}</th>
                <th class="px-6 py-4 font-bold">{{ __('Email') }}</th>
                <th class="px-6 py-4 font-bold">{{ __('Perfil') }}</th>
                <th class="px-6 py-4 font-bold">{{ __('Estado') }}</th>
                <th class="px-6 py-4 text-right font-bold">{{ __('Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
@endcomponent
@endsection
