@extends('ui.layout')
@section('page_key', 'ticket-detail')

@section('content')
<x-ui.partials.page-card
    :title="__('Detalhes do Ticket')"
    data-ticket-id="{{ $ticketId ?? $ticket->id ?? '' }}"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui/tickets'" :label="__('Voltar à Listagem')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid gap-4 xl:grid-cols-[1.2fr_0.8fr] items-start">

        <div class="space-y-4">

            <div id="ticketDetails" class="rounded-2xl border border-(--border) bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="text-xs text-(--text-soft) animate-pulse py-4 text-center">A carregar detalhes do ticket...</div>
            </div>

            <div class="rounded-2xl border border-(--border) bg-(--surface) p-4 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-(--text) border-b border-(--border) pb-2">{{ __('Histórico & Comentários') }}</h3>
                <div id="commentsSection" class="text-xs text-(--text-soft) max-h-28 overflow-y-auto pr-1 space-y-2">
                    <p class="italic py-1 text-center text-[11px]">{{ __('A carregar histórico...') }}</p>
                </div>
                <form id="commentForm" class="flex gap-2 items-center pt-2 border-t border-(--border)">
                    <input id="commentText" type="text" required class="flex-1 rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none focus:border-primary transition-all" placeholder="{{ __('Escreva uma mensagem...') }}">
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-extrabold uppercase tracking-wider bg-primary text-white hover:opacity-90 transition shadow-sm cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>
            </div>

            <div class="rounded-2xl border border-(--border) bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-(--text)">{{ __('Evidências Fotográficas') }}</h3>
                    <span class="text-[9px] font-bold text-(--text-soft) uppercase tracking-wider">{{ __('Anexos') }}</span>
                </div>
                <form id="photoForm" class="flex items-center gap-2 border-b border-(--border) pb-3">
                    <label for="photoInput" class="cursor-pointer rounded-xl bg-(--surface-2) border border-(--border) px-3 py-1.5 text-xs font-semibold text-(--text) hover:bg-(--border) transition whitespace-nowrap">
                        {{ __('Escolher') }}
                    </label>
                    <input id="photoInput" type="file" accept="image/*" class="hidden">
                    <span id="photoFileName" class="text-xs text-(--text-soft) truncate flex-1 block">{{ __('Nenhum ficheiro') }}</span>
                    <button type="submit" class="py-1.5 px-3 bg-(--surface-2) hover:bg-(--border) text-xs font-bold text-(--text) border border-(--border) rounded-xl transition cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>
                <div id="photosSection" class="text-xs text-(--text-soft)">
                    <p class="italic text-[11px]">{{ __('Nenhuma evidência carregada.') }}</p>
                </div>
            </div>

        </div>

        <div class="space-y-4">

            @if(isset($user) && $user && $user->isAdmin())
            <div id="budgetApprovalCard" class="hidden rounded-2xl border border-amber-500/40 bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-amber-500 bg-amber-500/10 border border-amber-500/20 rounded-lg">{{ __('Aprovação Orçamental') }}</span>
                    <span id="budgetEstimatedCost" class="text-xs font-black text-amber-400">0.00 €</span>
                </div>
                <div>
                    <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('Limiar de aprovação:') }} <span id="budgetThresholdDisplay">0.00 €</span></p>
                    <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('Técnico:') }} <span id="budgetTechnicianName">—</span></p>
                </div>
                <div id="budgetDetailsContainer" class="hidden">
                    <div class="rounded-xl border border-(--border) bg-(--surface-2) p-3">
                        <div id="budgetDetailsList"></div>
                        <div class="mt-2 pt-2 border-t border-(--border) flex justify-between text-xs font-bold">
                            <span>{{ __('Total') }}</span>
                            <span id="budgetDetailsTotal" class="font-mono">0.00 €</span>
                        </div>
                    </div>
                </div>
                <textarea id="budgetFeedback" rows="2" placeholder="{{ __('Justificação (obrigatório para recusar)...') }}" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) resize-none outline-none"></textarea>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" id="btnApproveBudget" class="py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">{{ __('Validar Orçamento') }}</button>
                    <button type="button" id="btnRejectBudget" class="py-2 bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">{{ __('Não Validar') }}</button>
                </div>
            </div>

            <div class="rounded-2xl border border-(--border) bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-orange-500 bg-orange-500/10 border border-orange-500/20 rounded-lg">{{ __('Painel do Admin') }}</span>
                    <span id="adminTicketId" class="text-xs font-mono font-bold text-(--text-soft)">#{{ $ticketId ?? $ticket->id ?? '' }}</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-(--text)">{{ __('Atribuição de Técnico') }}</h3>
                    <p class="text-[11px] text-(--text-soft) mt-0.5 leading-tight">{{ __('Defina manualmente o responsável ou solicite à IA para triagem automática.') }}</p>
                </div>
                <div class="space-y-2 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-(--text-soft) mb-1">{{ __('ID do Técnico (Manual)') }}</label>
                        <input id="assignTechnicianId" type="number" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2 text-xs text-(--text) outline-none" placeholder="{{ __('Ex: 12') }}">
                    </div>
                    <div class="space-y-2 pt-1">
                        <button id="btnAssignManual" type="button" class="w-full py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold rounded-xl border border-slate-700 shadow-sm transition cursor-pointer">{{ __('Atribuir Técnico') }}</button>
                        <button id="btnAssignAuto" type="button" class="w-full py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-extrabold rounded-xl shadow-md transition cursor-pointer flex items-center justify-center gap-1.5">{{ __('Atribuição Automática (IA)') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if(isset($user) && $user && $user->isTechnician())

            <div id="techStartCard" class="hidden rounded-2xl border border-primary/30 bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-lg">{{ __('Operacional') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Livre') }}</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-(--text)">{{ __('Assumir Ocorrência') }}</h3>
                    <p class="text-[11px] text-(--text-soft) mt-0.5 leading-tight">{{ __('Este ticket encontra-se livre. Caso tenha disponibilidade, assuma a reparação.') }}</p>
                </div>
                <div class="space-y-2">
                    <button type="button" id="btnStartRepair" class="w-full inline-flex items-center justify-center rounded-xl py-2.5 text-xs font-black uppercase tracking-wider bg-primary text-white hover:opacity-90 shadow-md shadow-orange-500/20 transition cursor-pointer">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path></svg>
                        {{ __('Iniciar Intervenção') }}
                    </button>
                    <button type="button" id="btnStartRepairForce" class="hidden w-full py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1.5">
                        <span>⚠️</span> {{ __('Forçar Início (ignorar prioritários)') }}
                    </button>
                </div>
            </div>

            <div id="techBudgetSubmitCard" class="hidden rounded-2xl border border-orange-500/30 bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-(--text)">{{ __('Avaliação Orçamental Detalhada') }}</h3>
                </div>
                <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('Introduza o orçamento estimado. Se o total exceder 50€, o ticket aguardará autorização da Administração.') }}</p>
                <div class="space-y-3 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-(--text-soft) mb-1.5">{{ __('Itens do Orçamento') }}</label>
                        <div id="budgetItemsContainer" class="space-y-1.5 mb-2"></div>
                        <button type="button" id="btnAddBudgetItem" class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold text-orange-500 bg-orange-500/10 border border-orange-500/30 rounded-lg hover:bg-orange-500/20 transition cursor-pointer">
                            + {{ __('ADICIONAR ITEM') }}
                        </button>
                    </div>
                    <div class="p-2.5 bg-(--surface-2) border border-(--border) rounded-xl flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase text-(--text-soft)">{{ __('Total Estimado') }}</span>
                        <span id="techTotalEstimatedDisplay" class="text-sm font-extrabold text-(--text)">0.00 €</span>
                    </div>
                    <input type="hidden" id="techEstimatedCostInput" name="estimatedBudget">
                    <button type="button" id="btnSubmitEstimatedBudget" class="w-full py-2.5 px-3 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">
                        {{ __('Submeter Orçamento Detalhado') }}
                    </button>
                </div>
            </div>

            <div id="techBlockedCard" class="hidden rounded-2xl border border-amber-500/30 bg-amber-500/5 p-4 shadow-sm space-y-2 text-center">
                <div class="text-xs font-bold text-amber-500">{{ __('Aguardar Validação Orçamental') }}</div>
                <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('O orçamento excede o limiar. O ticket aguarda aprovação da Administração.') }}</p>
            </div>

            <div id="techApprovedCard" class="hidden rounded-2xl border border-emerald-500/30 bg-(--surface) p-4 shadow-sm space-y-2">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-lg">{{ __('Autorizado') }}</span>
                    <span class="text-xs font-bold text-emerald-400">{{ __('Aprovado') }}</span>
                </div>
                <h3 class="text-xs font-bold text-(--text)">{{ __('Orçamento Aprovado') }}</h3>
                <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('O orçamento foi aprovado. Pode iniciar a reparação.') }}</p>
            </div>

            <div id="techRejectedCard" class="hidden rounded-2xl border border-rose-500/30 bg-rose-500/5 p-4 shadow-sm space-y-2">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-rose-500 bg-rose-500/10 px-2 py-0.5 rounded-lg">{{ __('Recusado') }}</span>
                </div>
                <p class="text-xs text-(--text-soft) text-center py-1">{{ __('Orçamento recusado pela Administração.') }}</p>
            </div>

            <div id="techCompletionCard" class="hidden rounded-2xl border border-emerald-500/30 bg-(--surface) p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-(--border) pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-lg">{{ __('A minha intervenção') }}</span>
                    <span class="text-xs font-bold text-emerald-400">{{ __('Autorizado') }}</span>
                </div>
                <p class="text-[11px] text-(--text-soft) leading-tight">{{ __('Intervenção autorizada. Conclua os trabalhos e registe os dados finais.') }}</p>
                <div class="space-y-2.5 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-(--text-soft) mb-1">{{ __('Custo Final (€)') }}</label>
                        <input type="number" id="techTotalCost" step="0.01" placeholder="0.00" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-1.5 text-xs text-(--text) font-mono">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-(--text-soft) mb-1">{{ __('Relatório Técnico') }}</label>
                        <textarea id="techFinalReport" rows="2" placeholder="{{ __('Descrição da reparação efetuada...') }}" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-1.5 text-xs text-(--text) resize-none"></textarea>
                    </div>
                    <button type="button" id="btnFinishTicket" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition cursor-pointer">
                        {{ __('Finalizar e Fechar Ticket') }}
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>

    <div id="ticketMessage" class="mt-4 min-h-6 px-1 text-xs font-medium transition-all duration-300"></div>

    <div id="priorityWarningModal" class="hidden fixed inset-0 z-[9999] items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-md rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-lg">{{ __('Prioridades') }}</span>
                <span class="text-lg font-bold text-amber-400">⚠️</span>
            </div>
            <div>
                <h3 class="text-sm font-black text-(--text)">{{ __('Atenção: Tickets Prioritários') }}</h3>
                <p id="priorityWarningCount" class="mt-1 text-xs text-(--text-soft) leading-relaxed"></p>
                <p id="priorityWarningCurrent" class="mt-1 text-xs text-(--text-soft)"></p>
                <p id="priorityWarningAction" class="mt-1 text-xs text-(--text-soft)"></p>
            </div>
            <div class="grid grid-cols-2 gap-2 pt-2">
                <button type="button" id="btnViewUrgentTickets" class="py-2 px-3 bg-primary text-white text-xs font-bold rounded-xl hover:opacity-90 transition cursor-pointer">{{ __('Ver Tickets Urgentes') }}</button>
                <button type="button" id="btnForceStartTicket" class="py-2 px-3 bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold rounded-xl transition cursor-pointer">{{ __('Prosseguir Mesmo Assim') }}</button>
            </div>
        </div>
    </div>

</x-ui.partials.page-card>
@endsection
