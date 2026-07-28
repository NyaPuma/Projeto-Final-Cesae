@extends('ui.layout')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Salas'),
    'subtitle' => __('Consulte e organize as salas e a sua relação com os equipamentos do inventário.'),
    'actions' => '<div class="flex items-center gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-800/60 hover:bg-slate-700/80 border border-slate-700/80 rounded-full transition-all">'
            . '<span>←</span> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddRoom" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-full shadow-sm transition-all cursor-pointer">+ ' . __('Nova sala') . '</button>'
        . '</div>'
])

    {{-- Painel de Filtros de Pesquisa --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <div class="sm:col-span-2 lg:col-span-2">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                    {{ __('Termo de Pesquisa') }}
                </label>
                <input id="filter_q" type="text" placeholder="{{ __('Pesquise por nome ou código da sala...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="filter_location" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                    {{ __('Edifício / Localização') }}
                </label>
                <input id="filter_location" type="text" placeholder="{{ __('Filtrar por edifício...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-5 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-5 py-2 text-xs font-semibold text-orange-500 bg-transparent border border-orange-500/40 hover:bg-orange-500/10 rounded-xl transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <div>
                <span id="resultsCount" class="text-xs font-medium text-[var(--text-soft)]"></span>
            </div>
    </div>

    {{-- Tabela de Dados --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table id="roomsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-3.5 font-bold">{{ __('Nome da Sala') }}</th>
                        <th class="px-5 py-3.5 font-bold">{{ __('Localização') }}</th>
                        <th class="px-5 py-3.5 font-bold">{{ __('Equipamentos') }}</th>
                        <th class="px-5 py-3.5 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="roomsTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                {{ __('A carregar listagem de salas...') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    {{-- Paginação --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent

{{-- Modal para Criar / Editar Sala (Fora do Component para Ficar 100% Fixo na Ecrã) --}}
<div id="roomModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-md rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto">
        <h3 class="text-base font-bold text-[var(--text)] mb-4" id="roomModalTitle">{{ __('Dados da Sala') }}</h3>
        <form id="roomForm" class="space-y-4">
            <input type="hidden" id="roomId" name="id">

            <div>
                <label for="roomName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome / Código da Sala') }}</label>
                <input id="roomName" name="name" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="roomLocation" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Localização') }}</label>
                <input id="roomLocation" name="location" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 pt-4 border-t border-[var(--border)]">
                <button type="button" data-modal="roomModal" class="px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="module">
        import { init } from '/resources/js/pages/rooms-management.js';
        window.requireAuthOnLoad = true;
        document.addEventListener('DOMContentLoaded', init);
    </script>
@endpush
