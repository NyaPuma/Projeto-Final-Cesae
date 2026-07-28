@extends('ui.layout')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Tickets'),
    'subtitle' => __('Pesquise, filtre e consulte as ocorrências registadas.'),
    'actions' => '<div class="flex flex-wrap gap-2">'
        . '<a href="' . route('ui.index') . '" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">'
            . '<svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">'
                . '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>'
            . '</svg> '
            . __('Voltar ao painel')
        . '</a>'
        . (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isCommonUser())
            ? '<a href="' . route('ui.tickets.create') . '" class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all">+ ' . __('Criar Ticket') . '</a>'
            : '')
        . '</div>'
])

    {{-- Painel de Pesquisa Avançada Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="filter_q" placeholder="{{ __('Pesquisar em título e descrição do ticket...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="filter_status" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado') }}</label>
                <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                    <option value="aberta">{{ __('Aberta') }}</option>
                    <option value="em curso">{{ __('Em Curso') }}</option>
                    <option value="fechada">{{ __('Fechada') }}</option>
                </select>
            </div>

            <div>
                <label for="filter_priority" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Prioridade') }}</label>
                <select id="filter_priority" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todas') }}</option>
                    <option value="baixa">{{ __('Baixa') }}</option>
                    <option value="média">{{ __('Média') }}</option>
                    <option value="alta">{{ __('Alta') }}</option>
                    <option value="crítica">{{ __('Crítica') }}</option>
                </select>
            </div>

            <div>
                <label for="filter_date_from" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Data de abertura (De)') }}</label>
                <input id="filter_date_from" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
            </div>

            <div>
                <label for="filter_date_to" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Data até') }}</label>
                <input id="filter_date_to" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="ui-button ui-button--primary inline-flex items-center justify-center px-4 py-2 text-[var(--on-primary)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="ui-button ui-button--outline inline-flex items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de tickets') }}">
        <div class="overflow-x-auto">
            <table id="ticketsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('ID') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Título') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Prioridade') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Sala') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Técnico') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="ticketsBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar listagem de tickets...') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Área de Paginação Alinhada --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent
@endsection

@push('scripts')
    <script type="module">
        import { init } from '/resources/js/pages/tickets-management.js';
        window.requireAuthOnLoad = true;
        document.addEventListener('DOMContentLoaded', init);
    </script>
@endpush

