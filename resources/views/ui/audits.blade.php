@extends('ui.layout')

@section('page_key', 'audits')

@section('content')
<x-ui.partials.page-header
    :title="__('messages.Auditoria do Sistema')"
    :subtitle="__('auth.Rastreabilidade, histórico de ações e registo de alterações efetuadas pelos utilizadores.')"
>
    <x-slot:actions>
        <div class="flex flex-wrap gap-2">
            <a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">
                <svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                {{ __('dashboard.Voltar ao painel') }}
            </a>
        </div>
    </x-slot:actions>

    {{-- Painel de Filtros --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2 lg:col-span-3">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Pesquisa Geral') }}</label>
                <input id="filter_q" placeholder="{{ __('auth.Pesquise por utilizador, elemento ou ID de registo...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
            </div>

            <div>
                <label for="filter_event" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Ação / Evento') }}</label>
                <select id="filter_event" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    <option value="">{{ __('common.Todas as Ações') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-col-reverse items-stretch gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex flex-1 sm:flex-none items-center justify-center px-4 py-2 bg-primary text-white text-xs font-bold rounded-xl shadow-sm hover:bg-primary-hover transition-all cursor-pointer min-h-[36px]">
                    {{ __('ui.Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex flex-1 sm:flex-none items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('common.Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Registos --}}
    <div class="ui-listing-table w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('common.Log ID') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Utilizador / Operador') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Elemento Afetado') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Referência') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Tipo de Ação') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('ui.Estado Anterior') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Novo Estado') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('common.Data e Hora') }}</th>
                    </tr>
                </thead>
                <tbody id="auditsTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                A carregar histórico de auditoria...
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginação --}}
    <div id="pagination" class="ui-listing-pagination mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>
</x-ui.partials.page-header>

@endsection

