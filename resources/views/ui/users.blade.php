@extends('ui.layout')
@section('page_key', 'users')
@section('content')
<x-ui.partials.page-header
    :title="__('common.Utilizadores')"
    :subtitle="__('messages.Consulte as contas dos utilizadores e os respetivos perfis de acesso ao sistema.')"
    badge="Utilizadores"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('dashboard.Voltar ao painel')" />
            <x-ui.page-actions.create-link :href="route('ui.users.create')" :label="__('ui.Criar Utilizador')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Painel de Filtros Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="usersSearch" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="usersSearch" placeholder="{{ __('common.Pesquise por nome, email...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="usersRole" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Perfil') }}</label>
                <select id="usersRole" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('common.Todos') }}</option>
                </select>
            </div>

            <div>
                <label for="usersStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Estado') }}</label>
                <select id="usersStatus" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('common.Todos') }}</option>
                    <option value="active">{{ __('equipment.Ativos') }}</option>
                    <option value="inactive">{{ __('equipment.Inativos') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-col-reverse items-stretch gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="ui-button ui-button--primary inline-flex flex-1 sm:flex-none items-center justify-center px-4 py-2 text-[var(--on-primary)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer min-h-[36px]">
                    {{ __('ui.Pesquisar') }}
                </button>
                <button id="btnClear" class="ui-button ui-button--outline inline-flex flex-1 sm:flex-none items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('common.Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada Clássica --}}
    <div class="ui-listing-table w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('common.Lista de utilizadores') }}">
        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-6 py-4 font-bold">{{ __('common.ID') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('common.Nome') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('common.Email') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('common.Perfil') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('common.Estado') }}</th>
                        <th class="px-6 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('ui.A carregar listagem de utilizadores...') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Área de Paginação Alinhada --}}
    <div id="pagination" class="ui-listing-pagination mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

</x-ui.partials.page-header>
@endsection

